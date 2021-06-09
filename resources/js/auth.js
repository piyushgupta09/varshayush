require('./bootstrap');

window.onload = function() {

    document
        .getElementById("collapse2FACode")
        .addEventListener("click", showRecoveryCodeInput);

    document
        .getElementById("collapseRecoveryCode")
        .addEventListener("click", showTfaCodeInput);

    function showRecoveryCodeInput() {
        let tfaCode = document.getElementById("collapse2FACode");
        tfaCode.style.display = 'none';
        let recoveryCode = document.getElementById("collapseRecoveryCode");
        recoveryCode.style.display = 'block';
    }

    function showTfaCodeInput() {
        let tfaCode = document.getElementById("collapse2FACode");
        tfaCode.style.display = 'block';
        let recoveryCode = document.getElementById("collapseRecoveryCode");
        recoveryCode.style.display = 'none';
    }
}
