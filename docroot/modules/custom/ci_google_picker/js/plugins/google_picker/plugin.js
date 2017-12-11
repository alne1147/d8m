/**
 * @file
 * Functionality to enable accordion functionality in CKEditor.
 */

(function () {
    'use strict';

    var script = document.createElement("script"); // Make a script DOM node
    script.src = 'https://apis.google.com/js/api.js'; // Set it's src to the provided URL
    script.async = 'async'; //set script load async
    document.head.appendChild(script); //attach script to head


    // Client ID and API key from the Developer Console
    var CLIENT_ID = '332349125167-cqat5skhit02hsteudeqtsigomtcevmh.apps.googleusercontent.com';

    // Scope to use to access user's photos.
    var scope = ['https://www.googleapis.com/auth/drive.readonly'];
    var pickerApiLoaded = false;
    var oauthToken;
    /**
     *  On load, called to load the auth2 library and API client library.
     */
    function handleClientLoad() {

        //gapi.load('client:auth2', initClient);
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
    }

    function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
                'client_id': CLIENT_ID,
                'scope': scope,
                'immediate': false
            },
            handleAuthResult);
    }

    function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
    }
    // Create and render a Picker object for picking user Photos.
    function createPicker() {
        if (pickerApiLoaded && oauthToken) {
            var picker = new google.picker.PickerBuilder().
            addView(google.picker.ViewId.PHOTOS).
            addView(new google.picker.DocsView().setIncludeFolders(true).setSelectFolderEnabled(true).setOwnedByMe(true)).
            addView(new google.picker.DocsView().setIncludeFolders(true).setSelectFolderEnabled(true).setOwnedByMe(false)).
            addView(new google.picker.DocsUploadView().setIncludeFolders(true)).
            enableFeature(google.picker.Feature.SIMPLE_UPLOAD_ENABLED).
            enableFeature(google.picker.Feature.MULTISELECT_ENABLED).
            enableFeature(google.picker.Feature.SUPPORT_TEAM_DRIVES).
            setOAuthToken(oauthToken).
            setOrigin(window.location.protocol + '//' + window.location.host).
            setCallback(pickerCallback).
            setAppId(CLIENT_ID).
            build();
            picker.setVisible(true);
        }
    }
    function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
            oauthToken = authResult.access_token;
            createPicker();
            CKEDITOR.dialog.getCurrent().hide();
        }
    }
    // A simple callback implementation.
    function pickerCallback(data) {
        console.log(JSON.stringify(data));
        var url = 'nothing';
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
            var doc = data[google.picker.Response.DOCUMENTS][0];
            var icon = "";
            var name = "";
            //console.log(doc);
            if(doc.mimeType === "application/vnd.google-apps.photo" || doc.mimeType === 'image/png' || doc.mimeType === 'image/gif'){
              icon = doc.thumbnails[4].url;
              name = "";
            }
            else {
              icon = doc.iconUrl;
              name = doc.name;
            }
            url = doc[google.picker.Document.URL];
        }
        if(url != 'nothing') {
            CKEDITOR.instances['edit-body-0-value'].insertHtml('<a href=' + url + '><img src=' + icon + '><span>' + name + '</span></a>');
				}

    }




    // Register plugin.
    CKEDITOR.plugins.add('google_picker', {
        hidpi: true,
        icons: 'google_picker',
        init: function (editor) {

            // Add single button.
            editor.ui.addButton('google_picker', {
                command: 'addgoogle_pickerCmd',
                icon: this.path + '../../../images/google-icon.svg',
                label: Drupal.t('Insert google_picker')
            });

            // Command to insert initial structure.
            editor.addCommand('addgoogle_pickerCmd', new CKEDITOR.dialogCommand('simpleLinkDialog'));

            CKEDITOR.dialog.add( 'simpleLinkDialog', function( editor )
            {
                return {
                    title : 'Login to Google',
                    minWidth : 200,
                    minHeight : 100,
                    contents :
                        [
                            {
                                id : 'general',
                                label : 'Google Drive Login',
                                elements :
                                    [
                                        {
                                          type: 'html',
                                          html: 'Click the button below to view your Drive.'
                                        },
                                        {
                                            id : 'authorize-button',
                                            type: 'button',
                                            label: 'Show my Google Drive',
                                            onClick: function() {
                                                handleClientLoad();
                                            }
                                        },
                                    ]
                            }
                        ]
                };
            });


        }
    });


})();
