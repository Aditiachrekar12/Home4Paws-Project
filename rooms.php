<?php
include('config/constants.php');
//get param
$roomname = $_GET['phone_number'];
?>
<!-- <!DOCTYPE html> -->
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
        }

        .container {
            border: 2px solid orangered;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: orangered;
            padding: 10px;
            margin: 10px 0;
        }

        .container-tb {
            background-color: #dedede;
            border-radius: 5px;
            width: 90%;
            height: 70px;
            padding: 10px;
            margin: 10px 0;
        }

        .btn_update {
            font-weight: bold;
            color: #FFFFFF;
            width: 50px;
            padding: 5px;
            background-color: #18e274;
            display: inline-block;
            cursor: pointer;
            text-align: center;
        }

        .btn_update:hover {
            color: #fff;
            background-color: #16b65f;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: orange;
        }

        .time-left {
            float: left;
            color: orange;
        }

        .anyClass {
            height: 350px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>

    <br>
    <br>

    <?php

    // $user_end_chatting = 0;

      if (isset($_SESSION['rooms'])) {
         echo $_SESSION['rooms'];
         
        //  unset($_SESSION['rooms']);
      }
    //   echo $user_end_chatting;
      ?>

    <h2>Chat Messages - <?php echo $roomname; ?></h2>

    <div class="container">
        <div class="anyClass">
        </div>
    </div>
    <input type="text" name="usermsg" id="usermsg" placeholder="E.g. Help me..." class="form-control" required>
    <button name="submitmsg" class="btn btn-secondary mt-2" id="submitmsg">Send</button>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // check for new message in every second
        setInterval(runFunction, 1000);

        function runFunction() {
            // for getting message in every one second using htcont.php
            $.post("htcont.php", {
                    room: '<?php echo $roomname; ?>'
                },
                function(data, status) {
                    document.getElementsByClassName('anyClass')[0].innerHTML = data;
                }
            )
        }

        // enter button clicked
        var input = document.getElementById("usermsg");

        // Execute a function when the user presses a key on the keyboard from https://www.w3schools.com/howto/
        input.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("submitmsg").click();
            }
        });


        // const ws = new WebSocket("wss://" + location.host + "/");
        $("#submitmsg").click(function() {
            var clientmsg = $("#usermsg").val();
            $.post("postmsg.php", {
                    text: clientmsg,
                    room: '<?php echo $roomname; ?>',
                    ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'
                },
                function(data, status) {
                    document.getElementsByClassName('anyClass')[0].innerHTML = data;
                });
            // for clearing the value on clicking
            $("#usermsg").val("");
            return false;
        });
    </script>
</body>

</html>