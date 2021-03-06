<?php

// validate data pribadi
$id = $_SESSION['id_user'];
$data_pribadi = "SELECT data_pribadi.id_user FROM data_pribadi INNER JOIN user ON data_pribadi.id_user = $id";
$sql = mysqli_query($connect, $data_pribadi);
$arr = mysqli_fetch_array($sql);

if ($arr == NULL && $_SESSION['status']=='belum lengkap') {
  echo"<script>alert('Maaf Menggangu, Silahkan Isi Data Pribadi Terlebih Dahulu');document.location='?modul=data_pribadi'</script>";
}

$id = $_SESSION['id_user'];
$status = $_SESSION['status'];


$query ="SELECT * FROM user WHERE id_user='$id'";
$que = mysqli_query($connect,$query);
$sql=mysqli_fetch_array($que);
?>

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                        src="<?php echo $sql['foto_profil']; ?>"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $sql['nama']; ?></h3>

                <p class="text-muted text-center"><?php echo $sql['nim']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo $sql['email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Role Akun</b> <a class="float-right"><?php echo $sql['role']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?php echo $sql['status']; ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tentang Saya</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-book mr-1"></i> Fakultas</strong>

                <p class="text-muted">
                  <?php echo $sql['fakultas']; ?>
                </p>

                <hr>

                <strong><i class="fa fa-map-marker mr-1"></i> Jurusan</strong>

                <p class="text-muted"><?php echo $sql['jurusan']; ?></p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Tanggal Lahir</strong>

                <p class="text-muted">
                  <?php echo $sql['tanggal_lahir']; ?>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Alamat</strong>

                <p class="text-muted"><?php echo $sql['alamat']; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data Diri</a></li>
                  <?php if($_SESSION['status'] == 'belum lengkap'){ ?>
                  <li class="nav-item"><a style="color: red" class="nav-link" href="#lengkap" data-toggle="tab">Lengkapi Data Diri *</a></li>
                <?php } else { ?>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Data Diri</a></li>
                  <li class="nav-item"><a class="nav-link" href="#fakuljur" data-toggle="tab">Edit Fakultas & jurusan</a></li>
                <?php } ?>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <h3>Data Diri Lainnya : </h3>
                      <span>Jenis Kelamin :  <?php echo $sql['jenis_kelamin']; ?></span><br><br>
                      <span>Password :  <?php echo $sql['password']; ?></span><br><br>
                      <span>Agama :  <?php echo $sql['agama']; ?></span><br><br>
                      <span>Golongan Darah :  <?php echo $sql['gol_dar']; ?></span><br><br>
                      <span>Nomor HP :  <?php echo $sql['no_hp']; ?></span><br><br>
                      <span>Orang Tua / Wali :  <?php echo $sql['ortu_wali']; ?></span><br><br>
                      <span>Nomor HP Orang Tua / Wali :  <?php echo $sql['no_hp_ortu']; ?></span> 
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="lengkap">
                    <form class="form-horizontal" method="post">
                      <input type="hidden" name="id_user" value="<?php echo $sql['id_user']; ?>">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Fakultas</label>

                        <div class="col-sm-10">
                          <select id="fakultas" class="form-control" name="fakultas">
                                                <option value="">Silahkan Pilih Fakultas</option>
                                                <?php
                                                    $sql1="SELECT * FROM fakultas";
                                                    $query1 = mysqli_query($connect,$sql1);
                                                    while ($row1 = mysqli_fetch_array($query1)) { ?>

                                                    <option value="<?php echo $row1['fakultas']; ?>">
                                                        <?php echo $row1['fakultas']; ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Jurusan</label>

                        <div class="col-sm-10">
                          <select id="jurusan" class="form-control" name="jurusan">
                            <option value="">Silahkan Pilih Jurusan</option>
                                                <?php
                                                  $sql2="SELECT * from jurusan join fakultas on jurusan.id_fakultas=fakultas.id_fakultas";
                                                    $query2 = mysqli_query($connect,$sql2);
                                                    while ($row2 = mysqli_fetch_array($query2)) { ?>

                                                    <option id="jurusan" class="<?php echo $row2['fakultas']; ?>" value="<?php echo $row2['jurusan']; ?>">
                                                        <?php echo $row2['jurusan']; ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                        </div>
                      </div>

                      <div class="col-sm-10">
                      <div class="form-group">
                  <label>Tanggal Lahir : </label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="date" name="tanggal_lahir" class="form-control">
                  
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                </div>

                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Agama</label>

                        <div class="col-sm-10">
                          <select class="form-control" name="agama">
                            <option value="">Silahkan Pilih Agama</option>
                            <option value="islam">Islam</option>
                            <option value="buddha">Buddha</option>
                            <option value="kristen">Kristen</option>
                            <option value="katholik">Katholik</option>
                            <option value="hindu">Hindu</option>
                            <option value="kong fu chu">Kong fu chu</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Jenis Kelamin</label>

                        <div class="col-sm-10">
                          Laki-laki &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Laki-laki"><br>
                          Perempuan &nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Perempuan">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Alamat" name="alamat"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Golongan Darah</label>

                        <div class="col-sm-10">
                          <select class="form-control" name="gol_dar">
                            <option value="">Silahkan Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Nomor HP</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Nomor HP" name="no_hp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Orang Tua / Wali</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Orang Tua / Wali" name="ortu_wali">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Nomor HP Orang Tua / Wali</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Nomor HP Orang Tua / Wali" name="no_hp_ortu">
                        </div>
                      </div>
                      <input type="hidden" value="lengkap" name="status">
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="lengkap" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="fakuljur">
                    <form class="form-horizontal" method="post">
                      <input type="hidden" name="id_user" value="<?php echo $sql['id_user']; ?>">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Fakultas</label>

                        <div class="col-sm-10">
                          <select id="fakultas1" class="form-control" name="fakultas">
                                                <option value="">Silahkan Pilih Fakultas</option>
                                                <?php
                                                $ques="SELECT * from fakultas";
                                                $sq=mysqli_query($connect,$ques);

                                                $id = $sql['fakultas'];

                                                $q="SELECT * FROM user join fakultas on user.fakultas=fakultas.fakultas where user.fakultas='$id'";
                                                $s=mysqli_query($connect,$q);
                                                $h=mysqli_fetch_array($s);

                                                foreach($sq as $row3) : ?>

                                                    <option <?php if( $row3['fakultas'] == $h['fakultas']){echo "selected"; } ?> value="<?php echo $row3['fakultas']; ?>">
                                                        <?php echo $row3['fakultas']; ?>
                                                    </option>

                                                <?php endforeach; ?>
                                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Jurusan</label>

                        <div class="col-sm-10">
                          <select id="jurusan1" class="form-control" name="jurusan">
                            <option value="">Silahkan Pilih Jurusan</option>
                                                <?php
                                                $que1="SELECT * from jurusan join fakultas on jurusan.id_fakultas=fakultas.id_fakultas";
                                                $sq1=mysqli_query($connect,$que1);

                                                $id1=$sql['jurusan'];
                                                $qu="SELECT * FROM user join jurusan on user.jurusan=jurusan.jurusan where user.jurusan='$id1'";
                                                $sa=mysqli_query($connect,$qu);
                                                $ha=mysqli_fetch_array($sa);

                                                foreach($sq1 as $row4) : ?>

                                                    <option <?php if( $row4['jurusan'] == $ha['jurusan']){echo "selected"; } ?> id="jurusan1" class="<?php echo $row4['fakultas']; ?>" value="<?php echo $row4['jurusan']; ?>">
                                                        <?php echo $row4['jurusan']; ?>
                                                    </option>

                                                <?php endforeach; ?>
                                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="fakuljur" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id_user" value="<?php echo $sql['id_user']; ?>">
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">NIM</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="NIM" name="nim" value="<?php echo $sql['nim']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Nama</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Nama" name="nama" value="<?php echo $sql['nama']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName2" placeholder="email" name="email" value="<?php echo $sql['email']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="password" name="password" value="<?php echo $sql['password']; ?>">
                        </div>
                      </div>
                      
                      <div class="col-sm-10">
                      <div class="form-group">
                  <label>Tanggal Lahir : </label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $sql['tanggal_lahir']; ?>">
                  
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                </div>

                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Agama</label>

                        <div class="col-sm-10">
                          <select class="form-control" name="agama">
                            <option value="">Silahkan Pilih Agama</option>
                            <option <?php if( $sql['agama'] =='islam'){echo "selected"; } ?> value="islam">Islam</option>
                            <option <?php if( $sql['agama'] =='buddha'){echo "selected"; } ?> value="buddha">Buddha</option>
                            <option <?php if( $sql['agama'] =='kristen'){echo "selected"; } ?> value="kristen">Kristen</option>
                            <option <?php if( $sql['agama'] =='katholik'){echo "selected"; } ?> value="katholik">Katholik</option>
                            <option <?php if( $sql['agama'] =='hindu'){echo "selected"; } ?> value="hindu">Hindu</option>
                            <option <?php if( $sql['agama'] =='kong fu chu'){echo "selected"; } ?> value="kong fu chu">Kong fu chu</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Jenis Kelamin</label>
                        <?php if($sql['jenis_kelamin']=='Laki-laki'){ ?>
                        <div class="col-sm-10">
                          Laki-laki &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Laki-laki" checked><br>
                          Perempuan &nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Perempuan">
                        </div>
                        <?php } else { ?>
                          <div class="col-sm-10">
                          Laki-laki &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Laki-laki"><br>
                          Perempuan &nbsp&nbsp<input type="radio" name="jenis_kelamin" value="Perempuan" checked>
                        </div>
                        <?php } ?>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Alamat</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Alamat" name="alamat"><?php echo $sql['alamat']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Golongan Darah</label>

                        <div class="col-sm-10">
                          <select class="form-control" name="gol_dar">
                            <option value="">Silahkan Pilih Golongan Darah</option>
                            <option <?php if( $sql['gol_dar'] =='A'){echo "selected"; } ?> value="A">A</option>
                            <option <?php if( $sql['gol_dar'] =='B'){echo "selected"; } ?> value="B">B</option>
                            <option <?php if( $sql['gol_dar'] =='AB'){echo "selected"; } ?> value="AB">AB</option>
                            <option <?php if( $sql['gol_dar'] =='O'){echo "selected"; } ?> value="O">O</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Nomor HP</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Nomor HP" name="no_hp" value="<?php echo $sql['no_hp']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Orang Tua / Wali</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Orang Tua / Wali" name="ortu_wali" value="<?php echo $sql['ortu_wali']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Nomor HP Orang Tua / Wali</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Nomor HP Orang Tua / Wali" name="no_hp_ortu" value="<?php echo $sql['no_hp_ortu']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Foto Profil</label>

                        <div class="col-sm-10">
                          <img src="<?php echo $sql['foto_profil']; ?>" width="100px" height="100px"> <span style="color: red">* Foto Lama Anda</span> 
                          <input type="file" class="form-control" id="inputName2" name="foto_profil">
                        </div>
                        <br>
                        <input type="hidden" value="<?php echo $sql['status']?>" name="status">
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="edit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
<?php
if(isset($_POST['lengkap'])){

$idu=$_POST['id_user'];
$fakultas=$_POST['fakultas'];
$jurusan=$_POST['jurusan'];
$tanggal=date("Y-m-d", strtotime($_POST['tanggal_lahir']));
$agama=$_POST['agama'];
$jk=$_POST['jenis_kelamin'];
$alamat=$_POST['alamat'];
$goldar=$_POST['gol_dar'];
$nohp=$_POST['no_hp'];
$orwa=$_POST['ortu_wali'];
$norw=$_POST['no_hp_ortu'];
$status=$_POST['status'];

$a="UPDATE user set fakultas='$fakultas', jurusan='$jurusan', tanggal_lahir='$tanggal', agama='$agama', jenis_kelamin='$jk', alamat='$alamat', gol_dar='$goldar', no_hp='$nohp', ortu_wali='$orwa', no_hp_ortu='$norw', status='$status' where id_user='$idu'";
$hasil = mysqli_query($connect,$a);

echo "<script>alert('Anda telah melengkapi data diri yang diperlukan');document.location='../mahasiswa/index.php'</script>";
}

if(isset($_POST['edit'])){

$idu=$_POST['id_user'];
$tanggal=date("Y-m-d", strtotime($_POST['tanggal_lahir']));
$agama=$_POST['agama'];
$jk=$_POST['jenis_kelamin'];
$alamat=$_POST['alamat'];
$goldar=$_POST['gol_dar'];
$nohp=$_POST['no_hp'];
$orwa=$_POST['ortu_wali'];
$norw=$_POST['no_hp_ortu'];
$status=$_POST['status'];
$nim=$_POST['nim'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$password=$_POST['password'];

$lokasi_file=$_FILES['foto_profil']['tmp_name'];
  $nama_file=basename($_FILES['foto_profil']['name']);

  $q="../assets/foto_user/$nama_file";

  if(move_uploaded_file($lokasi_file, "$q"))
    {
$b="UPDATE user set tanggal_lahir='$tanggal', agama='$agama', jenis_kelamin='$jk', alamat='$alamat', gol_dar='$goldar', no_hp='$nohp', ortu_wali='$orwa', no_hp_ortu='$norw', status='$status',nim='$nim',nama='$nama',email='$email',password='$password',foto_profil='$q' where id_user='$idu'";
$hasil = mysqli_query($connect,$b);

echo "<script>alert('Anda Telah Melengkapi Data Diri...');document.location='../mahasiswa/index.php'</script>";
}
else
{
$b="UPDATE user set tanggal_lahir='$tanggal', agama='$agama', jenis_kelamin='$jk', alamat='$alamat', gol_dar='$goldar', no_hp='$nohp', ortu_wali='$orwa', no_hp_ortu='$norw', status='$status',nim='$nim',nama='$nama',email='$email',password='$password' where id_user='$idu'";
$hasil = mysqli_query($connect,$b);

echo "<script>alert('Anda Telah Melengkapi Data Diri...');;document.location='../mahasiswa/index.php'</script>";

}

}

if(isset($_POST['fakuljur'])){

$fakultas=$_POST['fakultas'];
$jurusan=$_POST['jurusan'];
$idu=$_POST['id_user'];

$c="UPDATE user set fakultas='$fakultas', jurusan='$jurusan' where id_user='$idu'";
$hasil = mysqli_query($connect,$c);

echo "<script>alert('Anda Telah Mengedit Fakultas dan Jurusan...');document.location='../mahasiswa/index.php'</script>";
}  
?>
