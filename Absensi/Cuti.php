<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel = "icon" href ="../Icon/Sign_only_Inverted/Transparent.png" type = "image/x-icon">
    <link rel="stylesheet" href="styleCuti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="logo">
                <h1>Officia</h1>
            </div> 
            <nav>
                <ul>
                    <li><a href="Home.html">DASHBOARD</a></li> 
                    <li><a href="Absen.html">ABSEN</a></li>
                    <li><a style="cursor: pointer;" onclick="Allert()"><u style="color: rgb(190, 190, 190); text-shadow: 0px 0px 20px white;">CUTI</u></a></li>
                    <li><a href="DataAbsen.html">DATA ABSEN</a></li>
                    <li><a href="../Main Tab/etc/Main.php">PROFILE</a></li>
                </ul>
            
                <div class="menu-toggle">
                    <input type="checkbox">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <section id="Cuti">
        <div class="table">
            <table>
                <form action="">
                    <h1 class="jf">Cuti Karyawan</h1>

                    <tr>
                        <td>Jenis Cuti </td>
                        <td> : </td>
                        <td>
                            <select name="cuti">
                                <option value=""></option>
                                <option value="ct">Cuti Tahunan</option>
                                <option value="cs">Cuti Sakit</option>
                                <option value="cb">Cuti Besar</option>
                                <option value="ch">Cuti Hamil</option>
                                <option value="cp">Cuti Penting</option>
                                <option value="cbr">Cuti Bersama</option>
                            </select>
                        </td>
                    </tr><br>

                    <tr>
                        <td>Dari Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>

                    <tr>
                        <td>Sampai Tanggal</td>
                        <td>:</td>
                        <td>
                            <input type="date">
                        </td>
                    </tr>

                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                            <textarea class="ktr" name="keterangan" cols="30" rows="5"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" align="center"><button onClick="confirm('Apakah Anda Yakin Ingin Cuti?...')" class="kirim" type="submit" name="kirim">Kirim</button></td> 
                    </tr>
                </form>
            </table>
        </div>
    </section>

    <footer>
        <p class="copy">Absensi Online, Copyright &copy;2021 by Officia. All Right Reserved</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</body>
</html>