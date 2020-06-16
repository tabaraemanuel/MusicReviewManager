<?php

use function PHPSTORM_META\type;

class transfer extends Controller{
public function index($name = ''){
        $this->view('transfer');
    }

    public function error($error = ""){
        $error = str_replace('_', ' ', $error);
        $this->view('transfer',['error' => $error]);
    }

    private function getid($song,$album,$conn){
        $selectQuery = "SELECT id from metadata where songName =? and artists=?";
            $selectStmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($selectStmt,$selectQuery)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/transfer/error/" . $msg);        
                exit();
            }
            mysqli_stmt_bind_param($selectStmt,"ss",$song,$album);
            $selectStmt->execute();
            $numberofrows = $selectStmt->num_rows;
            if($numberofrows !=1){
                return  -1;
            }
            $selectStmt->store_result();
            $selectStmt->bind_result($id);
            $selectStmt->fetch();
            $result = $id;
            $selectStmt->free_result();
            $selectStmt->close();
            return $result;
    }

    private function deleteFile($conn,$username){
        $deleteQuery = "DELETE FROM favfiles where username =?";
            $deleteStmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($deleteStmt,$deleteQuery)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/main/error/" . $msg);        
                exit();
            }
            mysqli_stmt_bind_param($deleteStmt,"s",$username);
            if(!mysqli_stmt_execute($deleteStmt)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/main/error/" . $msg);        
                exit();
            }

            $deleteStmt->close();
    }



    private function sendFile($file,$conn){
        $username = $_SESSION['username'];
        $sendQuery = "INSERT INTO favfiles (username,file) values (?,?) ";
            $selectStmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($selectStmt,$sendQuery)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/transfer/error/" . $msg);        
                exit();
            }
            mysqli_stmt_bind_param($selectStmt,"ss",$username,$file);
            $selectStmt->execute();
            $numberofrows = $selectStmt->num_rows;
            if($numberofrows !=1){
                return  -1;
            }
            $selectStmt->free_result();
            $selectStmt->close();

    }




    private function post_playlist($tracks, $playlistTitle,$creator,$content){
            header('Acces-Control-Allow-Origin: *');
            header('Content-Type: application/json');        
            include_once  "../app/API/database.php";
            
            include_once  "../app/models/post.php";
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $servername = "localhost";
            $dbusername = "root";
            $dbpass = "";
            $databse = "Proiect";
            $username = $_SESSION['username']; 
            $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
            $this->deleteFile($conn,$username);
            
            $this->sendFile($content,$conn);
            $size = count($tracks);
            
            $deleteQuery = "DELETE FROM favorites where username =?";
            $deleteStmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($deleteStmt,$deleteQuery)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/main/error/" . $msg);        
                exit();
            }
            mysqli_stmt_bind_param($deleteStmt,"s",$username);
            if(!mysqli_stmt_execute($deleteStmt)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/main/error/" . $msg);        
                exit();
            }
            $deleteStmt->close();
            $username = $_SESSION['username'];
            for($repeat = 0; $repeat < $size;$repeat++){         
                
                $songName = $tracks[$repeat]['title'];
                $albumName = $tracks[$repeat]['album'];
                $artists = $tracks[$repeat]['creator'];
                
                if(empty($songName)  || empty($albumName) || empty($artists)){
                    $msg = "Broken file!";
                    header("Location: http://localhost/phplessons/public/transfer/error/" . $msg );
                    exit();
                }else
                {   
                    $id = $this->getid($song,$id,$conn);
                    $query = "INSERT INTO favorites (username,songid,playlistTitle,creator,song,artists,album) VALUES (?,?,?,?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn); 
                    if(!mysqli_stmt_prepare($stmt,$query)){
                        $msg= "Database Error!";
                        header("Location: http://localhost/phplessons/public/transfer/error/" . $msg);        
                        exit();
                    }else{
                        mysqli_stmt_bind_param($stmt,"sisssss",$username,$id,$playlistTitle,$creator,$songName,$artists,$albumName);
                        mysqli_stmt_execute($stmt);
                        if(mysqli_affected_rows($conn) >0){
                            if(isset($stmt))
                            {
                                mysqli_stmt_close($stmt);
                            }
                        }else{
                            $msg = "Database Error!";
                            header("Location: http://localhost/phplessons/public/transfer/save/" . $msg);
                            exit();
                        }
                    }
                }
            }
            if(isset($conn)){
                $conn->close();
            }
            
        return true;
    }


  


    public function import(){
        session_start();
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            if(isset($_POST['import-submit'])){
            $file =$_FILES['file-send'];
            
            if(gettype($file) == gettype(false)){
                header("Location: http://localhost/phplessons/public/transfer/error/Bad_file!");
                exit();
            }
            $fileName = $file['name']; 
            $tempName = $file['tmp_name']; 
            $filesize = $file['size']; 
            $fileError = $file['error']; 
            $fileName = $file['name']; 
            $fileType = $file['type'];

            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jspf');
            if(in_array($fileActualExt,$allowed)){
                if($fileError === 0){
                    $fileNewName = $_SESSION['username'] . ".jspf";
                    $fileDestination = "uploads" . '/' . $fileNewName;
                    move_uploaded_file($tempName,$fileDestination);

                }else{
                    header("Location: http://localhost/phplessons/public/transfer/error/File_error!");
                    exit();
                }
            }else{
                header("Location: http://localhost/phplessons/public/transfer/error/Not_jspf!");
                exit();
            }
             $fileDestination = "uploads" . '/' . $username . ".jspf";
             $newFile = file_get_contents($fileDestination);
             $parsedJson = json_decode($newFile,true);
            
            if(is_null($parsedJson)){
                
                header("Location: http://localhost/phplessons/public/transfer/ananar/Failed_parsing!" . gettype($newFile));
                exit();
            }
            $playlist = $parsedJson['playlist'];
            if(empty($parsedJson['playlist']) || empty($playlist['track']) || empty($playlist['creator']) || empty($playlist['title'])){
                header("Location: http://localhost/phplessons/public/transfer/error/Broken_File!");
                exit();
            }
            $tracks = $playlist["track"];
            $creator = $playlist["creator"];
            $title = $playlist["title"];
            $succes = $this->post_playlist($tracks,$title,$creator,$newFile);
            if($succes){
                header("Location: http://localhost/phplessons/public/main/transfer/Succes!");
              
                exit();
            }
            }else{
            header("Location: http://localhost/phplessons/public/transfer");
            exit();
            }
        }else{
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
    }


    private function getjson(){
        header('Acces-Control-Allow-Origin: *');
        header('Content-Type: application/json');        
        include_once  "../app/API/database.php";
        include_once  "../app/models/post.php";
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $servername = "localhost";
        $dbusername = "root";
        $dbpass = "";
        $databse = "Proiect";
        
        $username = $_SESSION['username']; 
        $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
        $selectQuery = "SELECT file from favfiles where username = ?";
            $selectStmt = mysqli_stmt_init($conn); 
            if(!mysqli_stmt_prepare($selectStmt,$selectQuery)){
                $msg= "Database Error!";
                header("Location: http://localhost/phplessons/public/transfer/error/" . $msg);        
                exit();
            }
            mysqli_stmt_bind_param($selectStmt,"s",$username);
            
            $selectStmt->execute();
            
            
         
            $selectStmt->store_result();
            $numberofrows = $selectStmt->num_rows;
               
            if($numberofrows !=1){
                $msg= "User has no playlist!";
                header("Location: http://localhost/phplessons/public/transfer/error/" . $msg);   
                exit();
            }
            $selectStmt->bind_result($id);
            $selectStmt->fetch();
            $result = $id;
            $selectStmt->free_result();
            $selectStmt->close();
            return $result;
      

    }



    public function export(){
            session_start();
            if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
                header("Cache-Control: public ");
                header("Content-Description: File Transfer");
                $filetext = $this->getjson();
                $docpath = "uploads" . "/" . $username . ".jspf";
                $content = $filetext;
                $fp = fopen($docpath,  "wb");
                fwrite($fp,$content);
                fclose($fp);
                $filename = $username . ".jspf";
                header("Content-Disposition: attachmen; filename=$filename");
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: binary");
                if(!readfile($docpath)){
                    header("Location: http://localhost/phplessons/public/transfer/error/No_playlist!");
                }
                exit();

            }else
            {
                header("Location: http://localhost/phplessons/public/login");
            }
            
            
        }
    
}
