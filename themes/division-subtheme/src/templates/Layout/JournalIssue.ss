$Header
<main class="main-content__container" id="main-content__container">

	<!-- Background Image Feature -->
	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>
	$Breadcrumbs
	
<% if not $BackgroundImage %>
	<div class="column row">
		<div class="main-content__header">
			<h1>$Title</h1>
		</div>
	</div>
<% end_if %>

$BlockArea(BeforeContent)

<div class="row">

	<article role="main" class="main-content main-content--with-padding <% if $SiteConfig.ShowExitButton %>main-content--with-exit-button-padding<% end_if %> <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% else %>main-content--full-width<% end_if %>">
		$BlockArea(BeforeContentConstrained)
		<div class="main-content__text">
			$Content
		</div>
		$BlockArea(AfterContentConstrained)
		$Form

		<div class="container padding">
				<div class="row">
					<div class="col-lg-12" >
				       <div class="issue-header">
				        	<h1>Issue {$Number}</h1>
				        	<h2 class="smallcaps subheader">$Date</h2>
				      	</div>
				      	<div class="article-card-container full-width row">
							<% loop $Children %>
				          		<li><a href="$Link">$Title</a></li>
				  			<% end_loop %>
				      	</div>
					</div>
				</div>
			</div>
			<div class="article-nav-container container">
				<div class="row article-card-container article-nav">
				    <div class="col-md-4 text-left">
				        <% if $PreviousIssue %>
				            <h2><a href="$PreviousIssue.Link">Previous Issue:</a></h2>
				            $PreviousIssue.Title
				        <% end_if %>
				    </div>
				    <div class="col-md-4 col-md-offset-4 text-right">
				        <% if $NextIssue %>
				            <h2><a href="$NextIssue.Link">Next Issue:</a></h2>
				            $NextIssue.Title
				        <% end_if %>
				     </div>
				 </div>
			</div>
		<%-- <% if $ShowChildPages %>
			<% include ChildPages %>
		<% end_if %> --%>
	</article>
	<aside class="sidebar dp-sticky">
		<% include SideNav %>
		<% if $SideBarView %>
			$SideBarView
		<% end_if %>
		$BlockArea(Sidebar)
	</aside>
</div>
$BlockArea(AfterContent)

</main>
