document.addEventListener("DOMContentLoaded", function() {
    var predictButton = document.getElementById("predict-button");
    predictButton.addEventListener("click", predictSales);
});

function predictSales() {
    var PE1 = parseInt(document.getElementById("PE1").value);
    var PE2 = parseInt(document.getElementById("PE2").value);
    var PE3 = parseInt(document.getElementById("PE3").value);
    var PE4 = parseInt(document.getElementById("PE4").value);
    var PE5 = parseInt(document.getElementById("PE5").value);
    var PE6 = parseInt(document.getElementById("PE6").value);

    var VG1 = parseInt(document.getElementById("VG1").value);
    var VG2 = parseInt(document.getElementById("VG2").value);
    var VG3 = parseInt(document.getElementById("VG3").value);

    var Ai = PE1 + PE2 + PE3;
    var Vi = VG1 + VG2 + VG3;
    var Ai2 = PE1 ** 2 + PE2 ** 2 + PE3 ** 2;
    var AiVi = (PE1 * VG1) + (PE2 * VG2) + (PE3 * VG3);
    var M = (3 * AiVi - Ai * Vi) / (3 * Ai2 - Ai ** 2);
    var B = (Vi - M * Ai) / 3;

    var V4 = M * PE4 + B;
    var V5 = M * PE5 + B;
    var V6 = M * PE6 + B;

    document.getElementById("VG4").textContent = V4.toFixed(2);
    document.getElementById("VG5").textContent = V5.toFixed(2);
    document.getElementById("VG6").textContent = V6.toFixed(2);
}
