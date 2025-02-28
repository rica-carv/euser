<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 *
 *
 * $Source: /cvs_backup/e107_0.8/e107_themes/templates/EUSER_SETTINGS_template.php,v $
 * $Revision$
 * $Date$
 * $Author$
 */

if (!defined('e107_INIT')) { exit; }

	
	
	
// e107 v2. bootstrap3 compatible template. 
$EUSER_SETTINGS_WRAPPER['edit']['USERNAME'] =				"
															  <div class='form-group row align-items-center'>
															<label for='username' class='col-sm-3 control-label'>{LAN=USER_01}</label>
														    <div class='col-sm-9'>{---}</div>
														   </div>
														";


$EUSER_SETTINGS_WRAPPER['edit']['LOGINNAME'] = 			"
														<div class='form-group row align-items-center'>
															<label for='loginname' class='col-sm-3 control-label'>{LAN=USER_81}</label>
														       	<div class='col-sm-9'>{---}</div>
														   </div>
														";

$EUSER_SETTINGS_WRAPPER['edit']['PASSWORD1'] = 			"<div class='form-group row align-items-center'>
															<label for='password1' class='col-sm-3 control-label'>{LAN=USET_24}</label>
														       	<div class='col-sm-9'>{---}</div>
														   </div>
														";
$EUSER_SETTINGS_WRAPPER['edit']['PASSWORD2'] =			"<div class='form-group row align-items-center'>
															<label for='password2' class='col-sm-3 control-label'>{LAN=USET_25}</label>
														       	<div class='col-sm-9'>{---}</div>
														   </div>
														";

$EUSER_SETTINGS_WRAPPER['edit']['REALNAME'] =			"<div class='form-group row align-items-center'>
															<label for='realname' class='col-sm-3 control-label'>{LAN=USER_63}{REQUIRED=realname}</label>
														       	<div class='col-sm-9'>{---}</div>
														   </div>
														";

$EUSER_SETTINGS_WRAPPER['edit']['CUSTOMTITLE'] =			"<div class='form-group row align-items-center'>
															<label for='customtitle' class='col-sm-3 control-label'>{LAN=USER_04}:{REQUIRED=customtitle}</label>
														       	<div class='col-sm-9'>{---}</div>
														   </div>
														";

$EUSER_SETTINGS_WRAPPER['edit']['USERCLASSES'] = 			"<div class='form-group row align-items-center'>
															<label  class='col-sm-3 control-label'>{LAN=USER_76}:{REQUIRED=class}</label>
														       	<div class='col-sm-9 checkbox'>{---}</div>
														   </div>
														";
/*
$EUSER_SETTINGS_WRAPPER['edit']['AVATAR_UPLOAD'] = 		"<div class='form-group row align-items-center'>
														<label for='avatar' class='col-sm-3 control-label'>{LAN=USET_26}</label>
												       	<div class='col-sm-9'>{---}</div>
													   	</div>
														";
*/
$EUSER_SETTINGS_WRAPPER['edit']['PHOTO_UPLOAD'] = 		"<div class='form-group row align-items-center'>
														<label for='photo' class='col-sm-3 control-label'>{LAN=USER_06}</label>
												       	<div class='col-sm-9'>{---}</div>
													   	</div>
														";
														
														

$EUSER_SETTINGS_WRAPPER['edit']['SIGNATURE']			= "<div class='form-group row align-items-center'>
														<label for='signature' class='col-sm-3 control-label'>{LAN=USER_71}{REQUIRED=signature}</label>
												       	<div class='col-sm-9'>{---}</div>
													   	</div>
													 ";

$EUSER_SETTINGS_WRAPPER['edit']['EMAIL']			= '<div class="form-group row align-items-center">
													 <label for="email" class="col-sm-3 control-label">{LAN=USER_60}{REQUIRED=email}</label>
													 <div class="col-sm-4">
														 {---}
													 </div>
													 ';

$EUSER_SETTINGS_WRAPPER['edit']['HIDEEMAIL']			= '	
	<label for="hideemail" class="col-sm-3 control-label border-0">{LAN=USER_83}</label>
	<div class="col-sm-2 border-0">
														 {---}
													 </div>
													 </div>';

$EUSER_SETTINGS_WRAPPER['edit']['AVATAR_REMOTE']			= '	
													 	<div class="form-group row  align-items-center">
	<label class="control-label col-sm-3">{LAN=USER_07}{REQUIRED=image}:</label>
	<div class="col-sm-9">
																										  {---}
																									  </div>
																									  </div>';

$EUSER_SETTINGS_WRAPPER['edit']['DELETEACCOUNTBUTTON']			= '<div class="float-end">{---}</div>';
												 
	// $EUSER_SETTINGS_WRAPPER['edit']['USEREXTENDED_ALL']	= "<div class='form-group'>{---}</div>";
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_INFOWATCH']			= '
	<div class="fw-bolder p-2 pt-4">{LAN=EUSERPROFILE_10} - {LAN=EUSERPROFILE_21}</div>
	<div class="form-group row align-items-center">
	<label for="infovis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_12}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROFRIENDS']			= '
	<div class="fw-bolder p-2 pt-4">{LAN=EUSERPROFILE_10} - {LAN=EUSERPROFILE_130}</div>
	<div class="form-group row align-items-center">
	<label for="friendvis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_13}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PMONFRIEND']			= '
	<div class="form-group row align-items-center">
	<label for="pmfriend" class="col-sm-6 control-label border-0">{LAN=EUSERPROFILE_22}</label>
	<div class="col-sm-6 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_EMAILONFRIEND']			= '
	<div class="form-group row align-items-center">
	<label for="emfriend" class="col-sm-6 control-label border-0">{LAN=EUSERPROFILE_23}</label>
	<div class="col-sm-6 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_SHOWFRIENDBUTTON']			= '
	<div class="form-group row align-items-center">
	<label for="showfrbut" class="col-sm-6 control-label border-0">{LAN=EUSERPROFILE_24}</label>
	<div class="col-sm-6 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROCOMMWATCH']			= '
	<div class="form-group row align-items-center">
	<label for="prcommvis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_14}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROCOMM']			= '	<div class="form-group row align-items-center">
	<label for="prcom" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_15}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROPICWATCH']			= '
	<div class="fw-bolder p-2 pt-4">{LAN=EUSERPROFILE_10} - {LAN=EUSERPROFILE_140}</div>
	<div class="form-group row align-items-center">
	<label for="primgvis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_16}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROPICCOMM']			= '	<div class="form-group row align-items-center">
	<label for="primgcom" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_17}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROVIDWATCH']			= '
	<div class="fw-bolder p-2 pt-4">{LAN=EUSERPROFILE_10} - {LAN=EUSERPROFILE_150}</div>
	<div class="form-group row align-items-center">
	<label for="prvidvis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_18}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROVIDCOMM']			= '	<div class="form-group row align-items-center">
	<label for="prvidcom" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_19}</label>
	<div class="col-sm-9 border-0">{---}</div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROMP3']			= '	<div class="form-group row align-items-center">
	<label for="prmp3vis" class="col-sm-3 control-label border-0">{LAN=EUSERPROFILE_20}</label>
	<div class="col-sm-9 border-0">{---}<div class="d-inline-flex ms-4">
	{EUSER_MP3_SET}
	</div></div></div>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_PROFILE_STATS']			= '	<div class="fw-bolder p-2 pt-4">{LAN=EUSERPROFILE_11}</div>
	<div class="container">{---}</div>';

	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_FRIENDS_EDIT:caption'] = "<li><a class='tab-friends nav-link' data-bs-toggle='tab' href='#euser-friends'>{---}</a></li>";
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_IMAGES_EDIT:caption'] = '<li><a class="tab-images nav-link" data-bs-toggle="tab" href="#euser-images">{---}</a></li>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_VIDEOS_EDIT:caption'] = '<li><a class="tab-videos nav-link" data-bs-toggle="tab" href="#euser-videos">{---}</a></li>';
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_FRIENDS_EDIT:'] = "<div id='euser-friends' class='tab-pane fade panel-body'>{---}</div>";
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_IMAGES_EDIT:'] = "<div id='euser-images' class='tab-pane fade panel-body'>{---}</div>";
	$EUSER_SETTINGS_WRAPPER['edit']['EUSER_VIDEOS_EDIT:'] = "<div id='euser-videos' class='tab-pane fade panel-body'>{---}</div>";


// Bootstrap only.

$EUSER_SETTINGS_TEMPLATE['edit'] = '
{EUSER_WARN}
<div class="euser-profile row">
    <div class="col-md-12">
	    <div class="panel panel-default panel-profile">
	      	<div class="panel-body">
	        	<div class="row border-0">
	            	<div class="col">
    	          		<div class="tabbed-menu">
        	        		<div class="tabbed-menu-body">
            	      			<div class="tabs-wrapper">
                  <div class="card with-nav-tabs bg-light">
                  <div class="card-header">
                	    			<ul class="nav nav-tabs" role="tablist">
		                    			<li><a class="tab-home active nav-link" data-bs-toggle="tab" href="#euser-home" data-bs-toggle="tab" href="#euser-settings" data-bs-original-title="{LAN=PROFILE_185}" title="{LAN=PROFILE_185}">{LAN=LAN_418}</a></li>
	        		              		<li><a class="tab-euser-social nav-link" data-bs-toggle="tab" href="#euser-social">{LAN=EUSERPROFILE_1}</a></li>
										{EUSER_FRIENDS_EDIT:caption}
        	              				{EUSER_IMAGES_EDIT:caption}
		    	                  		{EUSER_VIDEOS_EDIT:caption}
	        		              		<li><a class="tab-euser-settings nav-link" data-bs-toggle="tab" href="#euser-settings" data-bs-original-title="{LAN=PROFILE_170}" title="{LAN=PROFILE_170}">{LAN=EUSERPROFILE_102}</a></li>
	    			                </ul>
                    </div>
                  	<div class="card-body bg-white p-0">
    	        			        <div class="tab-content container m-0 mw-100">
        		        			    <div id="euser-home" class="tab-pane fade in active show" role="tabpanel">
                		    	    		<div class="d-flex row rows-col-2">

<div class="container">
	{USERNAME}
	{LOGINNAME}
	{EMAIL}
	{HIDEEMAIL=radio}
	{REALNAME}
	{CUSTOMTITLE}
	{PASSWORD1}
	{PASSWORD2}
	{AVATAR_REMOTE}
	{PHOTO_UPLOAD}
	{USERCLASSES}
	{USEREXTENDED_ALL=tabs}
	{SIGNATURE}
	{SIGNATURE_HELP}
</div>

                      						</div>
                   						</div>
                      						<div id="euser-social" class="tab-pane fade" role="tabpanel">
  												<div class="container p-4">
 												</div>
                		      				</div>
			            			        {EUSER_FRIENDS_EDIT:}
            			          			{EUSER_IMAGES_EDIT:}
			                      			{EUSER_VIDEOS_EDIT:}
                      						<div id="euser-settings" class="tab-pane fade" role="tabpanel">
               		    	    				<div class="d-flex row rows-col-2">
													<div class="container">
														{EUSER_INFOWATCH}
														{EUSER_PROCOMMWATCH}
														{EUSER_PROCOMM}
														{EUSER_PROMP3}
														{EUSER_PROFRIENDS}
														{EUSER_SHOWFRIENDBUTTON}
														{EUSER_PMONFRIEND}
														{EUSER_EMAILONFRIEND}
														{EUSER_PROPICWATCH}
														{EUSER_PROPICCOMM}
														{EUSER_PROVIDWATCH}
														{EUSER_PROVIDCOMM}
														{EUSER_PROFILE_STATS}
  													</div>
  												</div>
                		      				</div>
	                   					</div>
                  					</div>
                				</div>
              				</div>
            			</div>
            			</div>
            			</div>
          			</div>

        		</div>
        		<div class="col">
            		{USER_ADDONS}
            		{USER_EXTENDED_ALL}
        		</div>
    		</div>
		</div>
	</div>
	 <div class="form-group">
      <div class="col-sm-offset-3 text-center">
		{UPDATESETTINGSBUTTON}
		{DELETEACCOUNTBUTTON}
	</div>
</div>
';

$EUSER_SETTINGS_TEMPLATE['mp3'] = 
'
	<!-- Button trigger modal -->
<button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#MP3Modal">{LAN=EUSERPROFILE_103}
</button>
<!-- Modal -->
<div id="MP3Modal" class="modal fade " tabindex="-1" aria-labelledby="MP3ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="MP3ModalLabel">{LAN=EUSERPROFILE_103}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	{LAN=PROFILE_154}
<div class="col d-flex">
{EUSER_MUSIC_REMOTE:radio=1}
{EUSER_MUSIC_LOCAL:radio=1}
{EUSER_MUSIC_NONE:radio=1}
</div>
{EUSER_MUSIC_REMOTE}
{EUSER_MUSIC_LOCAL}
{EUSER_MUSIC_NONE}
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
';

$EUSER_SETTINGS_TEMPLATE['extended-category'] = "<h3>{CATNAME}</h3>";
$EUSER_SETTINGS_TEMPLATE['extended-field'] = "<div class='form-group'>
	<label class='col-sm-3 control-label'>{FIELDNAME} {REQUIRED}</label>
	<div class='col-sm-9'>
	{FIELDVAL} {HIDEFIELD}
	</div>
	</div>
											";

// ***** FIM DA TEMPLATE COPIADA DO USERSETTINGS
$EUSER_SETTINGS_TEMPLATE['edit_caption'] = EUSERPROFILE_101."&nbsp;{USER_NAME}";

$EUSER_SETTINGS_TEMPLATE['main'] = '
-----------------------------------------------









';

