<?php
// show('Inside layout');
// use Cmgift\System\Engine\Application;
?>

<!DOCTYPE html>
{{header}}
    {{topmenu}}
    {{mainmenu}}
        <div class="content">
            {{ribbon}}
            <div class="main">
                {{content}}
            </div>
        </div>
        <div class="divider gold"></div>
        {{bottom}}
    </div>

</body>
</html>