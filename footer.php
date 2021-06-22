<div id="footer" style="padding-top: 5px;">
    <div class="footer-left">
        <a href="termsofuses.php">Terms of use</a> |
        <a href="privacypolicy.php">Privacy Policy</a>
    </div>
    <div class="footer-right">Developed By - SMART SOLUTIONS</div>
</div>
<script type="text/javascript">
    if (document.layers) {
        //Capture the MouseDown event.
        document.captureEvents(Event.MOUSEDOWN);

        //Disable the OnMouseDown event handler.
        document.onmousedown = function () {
            return false;
        };
    } else {
        //Disable the OnMouseUp event handler.
        document.onmouseup = function (e) {
            if (e != null && e.type == "mouseup") {
                //Check the Mouse Button which is clicked.
                if (e.which == 2 || e.which == 3) {
                    //If the Button is middle or right then disable.
                    return false;
                }
            }
        };
    }

//Disable the Context Menu event.
    document.oncontextmenu = function () {
        return false;
    };
</script>
