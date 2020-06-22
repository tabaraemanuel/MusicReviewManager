<?php
class main extends Controller
{

    public function getpdf()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            include_once  "../app/API/newdb.php";
            $myres = array();
            $conn = getconn();
            $sql = "SELECT count(username) as nrofusers from users";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofusers = $row['nrofusers'];
            $nrofusers--;
            $sql = "SELECT count(id) as nrofid from metadata";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofsongs = $row['nrofid'];
            $sql = "SELECT AVG(popularity) as avgofpop from metadata";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $avgpop = $row['avgofpop'];
            $sql = "SELECT count(DISTINCT(username)) as nrofcomms from comments";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofcomments = $row['nrofcomms'];
            $engagement = (doubleval($nrofusers) / doubleval($nrofcomments));
            $engagement *= 100;
            require_once("../app/libraries/tcpdf_min/tcpdf.php");
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator("Music Review Manager");
            $pdf->SetTitle("Music Review Manager Statistici");
            $pdf->setHeaderData("", "", "Music Review Manager", "Statistics");
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setFontSubsetting(true);
            $pdf->SetFont('helvetica', '', 14, '', false);
            $pdf->AddPage();
            $content = "Number of users = " . $nrofusers . ";
Number of songs in the database =" . $nrofsongs . ";
Average song rating =" . $avgpop . ";
Percentage of users that commented = " . $engagement . "%.";
            $pdf->Write(9.0, $content);
            ob_end_clean();
            $pdf->Output("stats.pdf", "D");
            exit();
        } else {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
    }

    public function getcsv()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            include_once  "../app/API/newdb.php";
            $myres = array();
            $conn = getconn();
            $sql = "SELECT count(username) as nrofusers from users";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofusers = $row['nrofusers'];
            $nrofusers--;
            $sql = "SELECT count(id) as nrofid from metadata";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofsongs = $row['nrofid'];
            $sql = "SELECT AVG(popularity) as avgofpop from metadata";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $avgpop = $row['avgofpop'];
            $sql = "SELECT count(DISTINCT(username)) as nrofcomms from comments";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $nrofcomments = $row['nrofcomms'];
            $engagement = (doubleval($nrofusers) / doubleval($nrofcomments));
            $engagement *= 100;
            $list = array(
                array("Music Review Manager Statistics"),
                array("Number of users", "Number of songs", "Average populariy of songs", "Pecentage of users that comment"),
                array($nrofusers, $nrofsongs, $avgpop, $engagement . "%")
            );
            $file = fopen("uploads/stats.csv", "wb");
            header("Cache-Control: public ");
            header("Content-Description: File Transfer");
            foreach ($list as $line) {
                fputcsv($file, $line);
            }
            fclose($file);
            $conn->close();
            header("Content-Disposition: attachmen; filename=stats.csv");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");
            if (!readfile("uploads/stats.csv")) {
                header("Location: http://localhost/phplessons/public/main/error!");
            }
            exit();
        } else {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
    }




    private function getalbums()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from albums order by releaseDate desc limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'albumName' => $row['albumName'],
                'artistName' => $row['artistName'],
                'releaseDate' => $row['releaseDate'],
                'image' => $row['image']
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }



    private function getpopular()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from metadata order by popularity desc limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'id' => $row['id'],
                'songName' => $row['songName'],
                'albumName' => $row['albumName'],
                'artists' => $row['artists'],
                'releaseDate' => $row['releaseDate'],
                'songImage' => $row['songImage'],
                'genre' => $row['genre'],
                'popularity' => $row['popularity']
            );

            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }

    private function getrecenttracks()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * FROM metadata ORDER BY STR_TO_DATE(releaseDate,'%Y-%c-%e') DESC limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'id' => $row['id'],
                'songName' => $row['songName'],
                'albumName' => $row['albumName'],
                'artists' => $row['artists'],
                'releaseDate' => $row['releaseDate'],
                'songImage' => $row['songImage'],
                'genre' => $row['genre'],
                'popularity' => $row['popularity']
            );

            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }



    public function index($name = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $songspop = $this->getpopular();
            $songsrec = $this->getrecenttracks();
            $albumsrec = $this->getalbums();
            $this->view('main', ['popular' => $songspop, 'recent' => $songsrec, 'album' => $albumsrec]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function save($msg = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->view('main', ['username' => $_SESSION["username"], 'msg' => $msg]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function transfer($msg = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $songspop = $this->getpopular();
            $songsrec = $this->getrecenttracks();
            $albumsrec = $this->getalbums();
            $this->view('main', ['popular' => $songspop, 'recent' => $songsrec, 'album' => $albumsrec, 'msg' => $msg]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
