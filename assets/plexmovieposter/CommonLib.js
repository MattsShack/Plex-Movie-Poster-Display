function ShowHideAdvanced() {
    $(document).ready(function(){

        $('.advanced-settingButton').click(function(){
        if ( this.value === 'HIDE ADVANCED' ) {
            // if it's open close it
            open = false;
            this.value = 'SHOW ADVANCED';
            // $(this).siblings("[value='Hide']").click();
            // $(this).next("div.showhideconfig").hide("fast"); // For <div.showhideconfig> post input
            $("div.advanced-setting").hide("fast"); // For <div.showhideconfig> global
        }
        else {
            // if it's close open it
            open = true;
            this.value = 'HIDE ADVANCED';
            // $(this).siblings("[value='Show']").click(); //to collapse the open divs - Disabled to allow for all divs to stay open
            // $(this).next("div.showhideconfig").show("fast"); // For <div.showhideconfig> post input
            $("div.advanced-setting").show("fast"); // For <div.showhideconfig> global
        }
        });

    });
}

function passwordView() {
    event.preventDefault();
    if ($('#password_view input').attr("type") == "text") {
        document.getElementById('password_view_btn').innerHTML = "Show";
        $('#password_view input').attr('type', 'password');
    } else if ($('#password_view input').attr("type") == "password") {
        $('#password_view input').attr('type', 'text');
        document.getElementById('password_view_btn').innerHTML = "Hide";
    }
}

function tokenView() {
    event.preventDefault();
    if ($('#token_view input').attr("type") == "text") {
        document.getElementById('token_view_btn').innerHTML = "Show";
        $('#token_view input').attr('type', 'password');
    } else if ($('#token_view input').attr("type") == "password") {
        $('#token_view input').attr('type', 'text');
        document.getElementById('token_view_btn').innerHTML = "Hide";
    }
}

function showName() {
    var name = document.getElementById('fileToUpload'); 
    //   alert('Selected file: ' + name.files.item(0).name);
    //   alert('Selected file: ' + name.files.item(0).size);
    //   alert('Selected file: ' + name.files.item(0).type);
    
    var ConfigFileName = name.files.item(0).name;
    
    var PostMSG = "Restore Configuration File: " + ConfigFileName;
    document.getElementById('configFileName').innerHTML = PostMSG;

}

function showName_font() {
    var name = document.getElementById('fileToUpload'); 
    //   alert('Selected file: ' + name.files.item(0).name);
    //   alert('Selected file: ' + name.files.item(0).size);
    //   alert('Selected file: ' + name.files.item(0).type);
    
    var FontFileName = name.files.item(0).name;
    
    var PostMSG = "Upload Font File: " + FontFileName;
    document.getElementById('UploadFileName').innerHTML = PostMSG;

}

function showName_zip() {
    var name = document.getElementById('zip_file'); 
    //   alert('Selected file: ' + name.files.item(0).name);
    //   alert('Selected file: ' + name.files.item(0).size);
    //   alert('Selected file: ' + name.files.item(0).type);
    
    var ZipFileName = name.files.item(0).name;
    
    // var PostMSG = "Upload Zip File: " + ZipFileName;
    var PostMSG = "Upload File: " + ZipFileName;
    document.getElementById('UploadFileName_Zip').innerHTML = PostMSG;

}

function exportFiles_ZIP() {
    //var name = document.getElementById('zip_file'); 
    //   alert('Selected file: ' + name.files.item(0).name);
    //   alert('Selected file: ' + name.files.item(0).size);
    //   alert('Selected file: ' + name.files.item(0).type);
    
    //var ZipFileName = name.files.item(0).name;
    
    // var PostMSG = "Upload Zip File: "; //+ ZipFileName;
    var PostMSG = "Upload File: "; //+ ZipFileName;
    document.getElementById('ExportFileName_Zip').innerHTML = PostMSG;

}