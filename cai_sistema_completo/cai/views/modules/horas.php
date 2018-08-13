<?php
    session_start();
    if(isset($_SESSION["user"])){
        echo"<script>
            window.location='index.php?action=home';
            </script>
        ";
    }
    $mvc = new MvcController();
    $mvc ->addHourController();

?>
<body style="background-color:#d3d3d3">
    <section class="content">
        <nav>
            <div class="nav-wrapper light-blue darken-4 col s8" >
                <a href="index.php?action=home" class="brand-logo">C<label style="font-size:20px">ENTRO DE </label> A<label style="font-size:20px">PRENDIZAJE DE </label> I<label style="font-size:20px">DIOMAS</label></a>
                <ul class="right hide-on-med-and-down ">
                    <li><a href="index.php?action=login">Log in</a></li>
                </ul>
            </div>
            
        </nav>
    </section>
    <div class="row">
        
        <div class="col s1"></div>
        <div class="card col s3">
            <h2>CAI hour</h2><br>
            <form method="post">
                <div class="row">
                   <div class="input-field col s12">
                        <select name="matricula">
                            <option selected disabled>Matricula</option>
                            <?php
                                $mvc->selectStudent();
                            ?>

                        </select>
                    </div>

                    <div class="input-field col s12">
                        <select name="actividad">
                            <option selected disabled>Activity</option>
                            <option>Reading</option>
                            <option>PC</option>
                            <option>Game</option>
                            <option>Homework</option>
                            <option>Listening</option>
                            <option>Acitivies with the Teacher</option>
                        </select>
                    </div>
                </div>
                <div class="input-field">
                    <button name="Iniciar" type="submit" class="waves-effect waves-light btn-large" style="width:320px;font-size:40px">Start</button>
                </div>
            </form>

        </div>
        <div class="col s1"></div>

        <div class="card col s6">
            <form method="post">
                <button name="finishAll" type="submit" class="waves-effect waves-light orange btn-large" style="width:420px;font-size:30px">Finish All Cai Hours</button>
                <table broder="1">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Student Name</th>
                            <th>Activity</th>
                            <th>Time of entry</th>
                            <th>Date</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $mvc ->showHourController();
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>
<?php
    $mvc->finishAllHoursController();
    $mvc->finishHourController();
    $mvc->cancelHourController();

?>