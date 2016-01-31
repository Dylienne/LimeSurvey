<?php
/**
 * This view display the right container of the updater
 * The ajax code change the active step.
 */
?>

	<!-- the ajax loader -->
	<div id="ajaxContainerLoading" >
		<p><?php eT('PLease wait, loading data...');?></p>
        <div class="preloader loading">
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
            <span class="slice"></span>
        </div>
	</div>

	<!-- Here come the different steps content. Content is loaded by the ajax request (see ./steps for html views)	-->
	<div id="updaterContainer">
		<!-- content loaded by ajax -->
	</div>
