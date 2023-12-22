<?php
// dump('Inside layout');
// use Cmgift\System\Engine\Application;
?>

<!DOCTYPE html>
{{header}}
<body>
    <div class="block header">
        {{topmenu}}
        {{search}}
        <!-- <div class="toscroll">
            <?php
            for ($i=0; $i < 6; $i++) { 
                echo '<div class="flash dot" style="animation-delay:'.(-1.6 + $i*0.2).'s;"></div>';
            }
            ?>
        </div>
        <div class="toscroll" style="right: 0; align-items: flex-start;">
            <?php
            for ($i=0; $i < 6; $i++) { 
                echo '<div class="flash dot" style="animation-delay:'.(-1.6 + $i*0.2).'s;"></div>';
            }
            ?>
        </div> -->
    </div>
    <div class="content">
        {{ribbon}}
        <div class="main">
            {{content}}
        </div>
    </div>
    {{bottom}}
</body>
<!-- <script type="text/javascript" src="assets/js/main.js"></script> -->
</html>