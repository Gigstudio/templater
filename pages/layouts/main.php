<?php
// dump('Inside layout');
// use Cmgift\System\Engine\Application;
?>

<!DOCTYPE html>
{{header}}
<body>
{{topmenu}}
{{mainmenu}}
    <div class="content">
        {{ribbon}}
        <div class="main">
            {{content}}
        </div>
    </div>
    {{bottom}}
</body>
</html>