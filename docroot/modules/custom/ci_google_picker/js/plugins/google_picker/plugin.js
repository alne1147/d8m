/**
 * @file
 * Functionality to enable accordion functionality in CKEditor.
 */

(function () {
    'use strict';

    var script = document.createElement("script"); // Make a script DOM node
    script.src = 'https://apis.google.com/js/api.js'; // Set it's src to the provided URL
    script.async = 'async';
    document.head.appendChild(script);

    // Client ID and API key from the Developer Console
    var CLIENT_ID = '332349125167-cqat5skhit02hsteudeqtsigomtcevmh.apps.googleusercontent.com';

    // Scope to use to access user's photos.
    var scope = ['https://www.googleapis.com/auth/drive'];
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
            setOAuthToken(oauthToken).
            setOrigin(window.location.protocol + '//' + window.location.host).
            setCallback(pickerCallback).

                setAppId('332349125167-cqat5skhit02hsteudeqtsigomtcevmh.apps.googleusercontent.com').
                //.setDeveloperKey(developerKey).
            build();
            picker.setVisible(true);
        }
    }
    function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
            oauthToken = authResult.access_token;
            createPicker();
        }
    }
    // A simple callback implementation.
    function pickerCallback(data) {
        var url = 'nothing';
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
            var doc = data[google.picker.Response.DOCUMENTS][0];
            url = doc[google.picker.Document.URL];
        }
        var message = 'You picked: ' + url;
        document.getElementById('cke_dialog_contents_89').innerHTML = message;
    }

    /**
     *  Sign out the user upon button click.
     */
    function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
    }






    // Register plugin.
    CKEDITOR.plugins.add('google_picker', {
        hidpi: true,
        icons: 'accordion',
        init: function (editor) {





            // Add single button.
            editor.ui.addButton('google_picker', {
                command: 'addgoogle_pickerCmd',
                icon: this.path + 'icons/accordion.png',
                label: Drupal.t('Insert google_picker')
            });


            // Command to insert initial structure.
            editor.addCommand('addgoogle_pickerCmd', new CKEDITOR.dialogCommand('simpleLinkDialog'));



            CKEDITOR.dialog.add( 'simpleLinkDialog', function( editor )
            {
                return {
                    title : 'Login to Google',
                    minWidth : 400,
                    minHeight : 200,
                    contents :
                        [
                            {
                                id : 'general',
                                label : 'Settings',
                                elements :
                                    [
                                        {
                                            id : 'authorize-button',
                                            type: 'button',
                                            label: 'Authorize',
                                            onClick: function() {
                                                handleClientLoad();
                                            }
                                        },
                                        {
                                            id: 'signout-button',
                                            type: 'button',
                                            label: 'Signout',
                                            onClick: function() {
                                                handleSignoutClick();
                                            }
                                        }
                                    ]
                            }
                        ]
                };
            });


        }
    });


})();
