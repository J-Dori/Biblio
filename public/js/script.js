// Get the modal for $_SESSION[MESSAGES] + DELETE Popup
var modalMsg = document.getElementById('messageModal');
var closeBtt = document.querySelector("#closeMsg");

closeBtt.addEventListener("click", function () {
    modalMsg.style.display = "none";
});


// Get the modal for EDIT : all except Message
function openEditModal(editID, editTable, editName) {
    document.querySelector('#modalPopup').setAttribute("style", "display: block");
    document.querySelector('#editConfModal').setAttribute("style", "display: block");
    document.getElementById('editID').innerText = editID;
    document.getElementById('editTable').innerText = editTable;
    document.getElementById('editTitle').innerHTML = "<strong>"+ editName +"</strong>";
}

function editCloseModal() {
    document.querySelector('#modalPopup').setAttribute("style", "display: none");
    document.querySelector('#editConfModal').setAttribute("style", "display: none");
}

function editConfirm() {
    var editID = document.getElementById('editID').innerText;
    var editTable = document.getElementById('editTable').innerText;
    
    window.location = "?ctrl="+  editTable.toLowerCase() +"&action=edit"+ editTable +"&id=" + editID;
}

// Get the modal for EDIT Messages
function openEditModalMsg() {
    document.querySelector('#modalPopup').setAttribute("style", "display: block");
    document.querySelector('#editConfModal').setAttribute("style", "display: block");
}


//NavBar - Hamburger
//var hamOpen = document.getElementsByClassName("hamOpen");
//var hamClose = document.getElementsByClassName("hamClose");

function hamOpen() {
    document.querySelector('.hamOpen').setAttribute("style", "display: none");
    document.querySelector('.hamClose').setAttribute("style", "display: block");
    document.querySelector('.navResp-links').setAttribute("style", "display: block");
}

function hamClose() {
    document.querySelector('.hamOpen').setAttribute("style", "display: block");
    document.querySelector('.hamClose').setAttribute("style", "display: none");
    document.querySelector('.navResp-links').setAttribute("style", "display: none");
}