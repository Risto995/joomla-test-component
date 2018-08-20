(function () {
    document.addEventListener("DOMContentLoaded", function (event) {
        var buildFirstEmailUrl = document.getElementById('cr-build-first-email-url').value,
            retrySyncUrl = document.getElementById('cr-retry-sync-url').value,
            buildEmailUrl = document.getElementById('cr-build-email-url').value,
            cronSyncUrl = document.getElementById('cr-cron-sync-url').value,
            buildEmailButton = document.getElementById('cr-buildEmail'),
            retrySynchronization = document.getElementById('cr-retrySync'),
            runCronSyncButton = document.getElementById('cr-cronSync');

        if (buildEmailButton) {
            buildEmailButton.addEventListener('click', function () {
                startBuildingEmail(buildEmailUrl + '#login');
            });
        } else {
            retrySynchronization.addEventListener('click', function () {
                sendAjax(retrySyncUrl);
            });
        }

        if (runCronSyncButton) {
            runCronSyncButton.addEventListener('click', function () {
                sendAjax(cronSyncUrl, function() {
                    var messageEl = document.getElementById('cr-popup-message');
                    if (messageEl) {
                        messageEl.classList.toggle('show');
                        setTimeout(function () {
                            messageEl.classList.toggle('show');
                        }, 4000);
                    }
                });
            });
        }
        function startBuildingEmail(buildEmailUrl) {
            sendAjax(buildFirstEmailUrl);
            var win = window.open(buildEmailUrl, '_blank');
            win.focus();
        }

        function sendAjax(url, callback) {
            CleverReach.Ajax.post(url + '&form_key=' + window.FORM_KEY, null, function (response) {
                if (response.status === 'success') {
                    if (callback) {
                        callback();
                    } else {
                        location.reload();
                    }
                }
            }, 'json', true);
        }
    });
})();