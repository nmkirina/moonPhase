<html>
    <head>
        <meta charset="UTF-8">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="js/bootstrap-datepicker.js" charset="UTF-8"></script>
    </head>
    <body>
        <div class="container well">
            <?php if(isset($_SESSION['error'])&&($_SESSION['error'])):?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error_message'];?>
                    <button type="button" class="close" data-dismiss="alert">x</button>
                </div>
            <?php endif;?>
            <div class="hero-unit">
                <h1>Вычисление фазы луны по дате</h1>
                <p>
                    Выберите дату.
                </p>
                <form action="main.php" method="POST">
                    
                    <div class="span5 col-md-5" id="sandbox-container">
                       
                        <input type="text" class="form-control" name="date">
                        
                    </div>
                                       
                    <button type="submit" class="btn btn-primary btn-large">Сгенерировать</button>
                </form>
                <?php if(isset($_SESSION['moonPhase'])):?>
                    <p>Дата: <b><?= $_SESSION['date'];?></b> Фаза луны: <b><?= $_SESSION['moonPhase']?> </b></p>
                <?php endif;?>
                    <div class="moon">
                        <div id="circle"></div>
                        <div class="circle_black"></div>
                    </div>
            </div>
        </div>
            <script>
              $('#sandbox-container input').datepicker();
              var phase = <?= $_SESSION['moonPhase']?>;
              
              var phasesShifts = [null, 0, -25, -50, -75, 100, 75, 50, 25];
              
              $('.circle_black').css({left: phasesShifts[phase]})
              
            </script>
    </body>
</html>



