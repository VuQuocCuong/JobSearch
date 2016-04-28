@extends('layout')
@section('content')
<!-- Begin content -->
<div id="main-div-after">
	<?php $item = $data[0]; ?>
	<div id="displayListing">
		<div class="clr"></div>
		<div id="listingsResults">
			<!-- LISTING INFO BLOCK -->
			<div class="listingInfo">
				<div class="job-title comp-profile-content">
					<a class="author-name" href="http://facebook.com/<?php echo ($item->author) ? $item->author : '#'; ?>" target="_blank">
						<?php echo ($item->author_name) ? $item->author_name : $item->author; ?>
					</a>
					Post on
					<a class="source-name" href="http://facebook.com/<?php echo ($item->id_source) ? $item->id_source : '#'; ?>" target="_blank">
						<?php echo ($item->name) ? $item->name : $item->id_source; ?>
					</a>
					<h2><?php echo ($item->title) ? $item->title : 'No Title'; ?></h2>
				</div>
				<div class="clr"></div>
				<div class="narrow-col-wrapper">
					<div class="clr"></div>
					<fieldset id="col-wide" class="active-fields sortable-column">
						<div class="displayFieldBlock">
							<h3>Mô tả công việc:</h3>
							<div class="displayField"><?php echo isset($item->message) ? nl2br($item->message) : ''; ?></div>
						</div>
					</fieldset>
					<div class="clr"></div>
					
					<div id="refineResults" class="company-info-right">
						<!-- PROFILE BLOCK -->
						<div class="userInfo">
							<div id="blockTop"></div>
							<div class="compProfileTitle"><?php echo isset($item->type) ? "Page info" : "Group info"; ?></div>
							<div class="compProfileInfo">
								<div class="comp-profile-content">
									<div class="text-center"><img src="http://graph.facebook.com/<?php echo isset($item->id_source) ? $item->id_source : ''; ?>/picture?height=150&width=150" alt=""></div>
									<div class="company-name">Source: <?php echo isset($item->name) ? $item->name : ''; ?></div>
									<div class="company-name">Author:	 <?php echo isset($item->author_name) ? $item->author_name : ''; ?></div>
									<div class="company-name">Time: <?php echo isset($item->created_at) ? $item->created_at : ''; ?></div>
									<a class="view-facebool" href="http://facebook.com/<?php echo isset($item->id_social) ? $item->id_social : ''; ?>" target="_blank" >View on facbeook</a>
									<br>
								</div>
								<div class="compProfileBottom"></div>
							</div>
							<!-- END PROFILE BLOCK -->
						</div>
						<div class="clr"><br></div>
					</div>
					<!-- END LISTING INFO BLOCK -->
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<div class="after-quick-links">
			<div class="Pagging">
			</div>
			<div class="clr"><br></div>
			<ul id="listing-details-menu">
				<li class="apply-now-li"></li>
				<li class="apply-now-li"><input type="button" class="buttonApply" value="Apply Now"></li>
				<li class="panelViewDitailsIco"><a href="#"><span>View Saved Jobs</span></a></li>
				<li class="tell-a-friend"><a href="#"><span>Tell a Friend</span></a></li>
			</ul>
			<div class="clr"></div>
		</div>
	</div>
	<!-- End Content -->
</div>
@endsection