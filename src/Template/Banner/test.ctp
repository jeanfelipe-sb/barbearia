
    <h1 class="main_title">Crop photo using PHP and jQuery</h1>
    <div class="content">
        <span class="upload_btn" onclick="show_popup('popup_upload')">Click to upload photo</span>
        <div id="photo_container">
        </div>
    </div><!-- content -->    
    <div class="footer">
        Powered by <a href="http://www.bewebdeveloper.com">bewebdeveloper.com</a>
    </div><!-- footer -->

<!-- The popup for upload new photo -->
<div id="popup_upload">
    <div class="form_upload">
        <span class="close" onclick="close_popup('popup_upload')">x</span>
        <h2>Upload photo</h2>
        
            <input type="file" name="photo" id="photo" class="file_input">
            <div id="loading_progress"></div>
        <?= $this->Html->link(__('New Banner'), array('action' => 'test','class'=>'btn-default')) ?>
        <iframe name="upload_frame" class="upload_frame"></iframe>
    </div>
</div>

<!-- The popup for crop the uploaded photo -->
<div id="popup_crop">
    <div class="form_crop">
        <span class="close" onclick="close_popup('popup_crop')">x</span>
        <h2>Crop photo</h2>
        <!-- This is the image we're attaching the crop to -->
        <img id="cropbox" />

        <!-- This is the form that our event handler fills -->
        <form>
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="photo_url" name="photo_url" />
            <input type="button" value="Crop Image" id="crop_btn" onclick="crop_photo()" />
        </form>
    </div>
</div>