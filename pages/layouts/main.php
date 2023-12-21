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