    </div><!-- maincontent -->
    <div id="footer">
    		<div id="topFoot">
                <a href="#" target="_blank"><i class="fa fa-facebook-square fa-2x" alt="Visit us on Facebook" style="vertical-align: middle;"></i></a>
                <a href="#" target="_blank"><i class="fa fa-twitter-square fa-2x" alt="Visit us on Twitter" style="vertical-align: middle;"></i></a>
                <a href="https://www.youtube.com/channel/UC69E02UldOKfW0ZYqDHRf7w" target="_blank"><i class="fa fa-youtube-play fa-2x" alt="Visit us on YouTube" style="vertical-align: middle;"></i></a>
                <a href="#" target="_blank"><i class="fa fa-linkedin-square fa-2x" alt="Visit us on Linked In" style="vertical-align: middle;"></i></a>
            </div>
            <div id="foot1">
            <p><strong>ABOUT</strong></p>
            <p><a href="#">Overview</a></p>
            <p><a href="#">History</a></p>
            <p><a href="#">Philosophy</a></p>
            <p><a href="#">Investment Process</a></p>
            <p><a href="#">Offices</a></p>
        </div>
        <div id="foot2">
            <p><strong>STRATEGIES</strong></p>
            <p><a href="#">Emerging Market CEF</a></p>
            <p><a href="#">Developed CEF</a></p>
            <p><a href="#">Frontier Markets Fund</a></p>
            <p><a href="#">GTAA CEF</a></p>
            <p><a href="#">Tactical Income CEF</a></p>
        </div>
        <div id="foot3">
            <p><strong>UCITS</strong></p>
            <p><a href="#">Emerging World Fund</a></p>
            <p><a href="#">Global Equity Fund</a></p>
            <p><a href="#">Emerging World Fund Italiano</a></p>
            <p><a href="#">Fund Prices</a></p>
            <p><a href="#">UK Tax</a></p>
        </div>
        <div id="foot4">
            <p><strong>INVESTOR RELATIONS</strong></p>
            <p><a href="#">Overview</a></p>
            <p><a href="#">Performance</a></p>
            <p><a href="#">Announcements</a></p>
            <p><a href="#">Reports</a></p>
            <p><a href="#">Financial Calendar</a></p>
        </div>
        <div id="foot5">
            <p><strong>REGULATORY INFO</strong></p>
            <p><a href="#">Disclaimer</a></p>
            <p><a href="#">Form ADV</a></p>
            <p><a href="#">UK Stewardship Code</a></p>
            <p><a href="#">Capital Requirements</a></p>
            <p><a href="#">Privacy & Cookie Policy</a></p>
        </div>
    	<div id="bottomFoot">
                <p>© <?php echo date('Y'); ?> City of London Investment Group PLC. All rights reserved.</p>
		</div>
    </div> 
</div>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="Scripts/jquery.slicknav.js"></script>
<script src="Scripts/accordion.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#menu').slicknav({
		label: '',
		prependTo:'#mobilemenu',
		closeOnClick:'true'
});
});
</script>
<script type="text/javascript">
</script>

<?php
// check if a script exists for the specified controller and load it
if (!empty($controller)) {
    if (file_exists('Scripts/'.$controller.'.js')) {
        ?>
        <script type="text/javascript" src="Scripts/<?php echo $controller.'.js'; ?>"></script>
        <?php
    }
}
// also load the action if available
if ( (!empty($controller)) && (!empty($action)) ) {
    if (file_exists('Scripts/'.$controller.'.'.$action.'.js')) {
        ?>
        <script type="text/javascript" src="Scripts/<?php echo $controller.'.'.$action.'.js'; ?>"></script>
        <?php
    }
}

?>

</body>
</html>
