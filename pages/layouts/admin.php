<?php
// dump('Inside layout');
// use Cmgift\System\Engine\Application;
?>

<!DOCTYPE html>
{{header}}
<body>
    <div class="content" id="admin">
        {{sidenavigator}}
        <div class="main">
            {{topmenu}}
            {{content}}
        </div>
    </div>
{{bottom}}
</body>
</html>