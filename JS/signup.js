function checkPasswordMatch() {
    if (document.getElementById("psw1").value == document.getElementById("psw2").value) {
        document.getElementById("confirmation").innerHTML = "Passwords match";
    } else {
        document.getElementById("confirmation").innerHTML = "Passwords don't match";
    }
}

function showLogin() {
    document.getElementById("login_form").style.display = "block";
    document.getElementById("register_form").style.display = "none";
}

function showRegister() {
    document.getElementById("login_form").style.display = "none";
    document.getElementById("register_form").style.display = "block";
}

function showPost() {
    document.getElementById("feedComp").style.display = "none";
    document.getElementById("profileComp").style.display = "none";
    document.getElementById("settingsComp").style.display = "none";
    document.getElementById("postComp").style.display = "block";

    document.getElementById("postBtn").classList.remove("headerBtnInactive");
    document.getElementById("feedBtn").classList.add("headerBtnInactive");
    document.getElementById("settingsBtn").classList.add("headerBtnInactive");
    document.getElementById("profileBtn").classList.add("headerBtnInactive");
}

function showFeed() {
    document.getElementById("feedComp").style.display = "block";
    document.getElementById("profileComp").style.display = "none";
    document.getElementById("settingsComp").style.display = "none";
    document.getElementById("postComp").style.display = "none";

    document.getElementById("feedBtn").classList.remove("headerBtnInactive");
    document.getElementById("postBtn").classList.add("headerBtnInactive");
    document.getElementById("settingsBtn").classList.add("headerBtnInactive");
    document.getElementById("profileBtn").classList.add("headerBtnInactive");
}

function showSettings() {
    document.getElementById("profileComp").style.display = "none";
    document.getElementById("settingsComp").style.display = "block";
    document.getElementById("postComp").style.display = "none";
    document.getElementById("feedComp").style.display = "none";

    document.getElementById("settingsBtn").classList.remove("headerBtnInactive");
    document.getElementById("postBtn").classList.add("headerBtnInactive");
    document.getElementById("feedBtn").classList.add("headerBtnInactive");
    document.getElementById("profileBtn").classList.add("headerBtnInactive");
}

function showProfile() {
    document.getElementById("feedComp").style.display = "none";
    document.getElementById("profileComp").style.display = "block";
    document.getElementById("settingsComp").style.display = "none";
    document.getElementById("postComp").style.display = "none";

    document.getElementById("profileBtn").classList.remove("headerBtnInactive");
    document.getElementById("postBtn").classList.add("headerBtnInactive");
    document.getElementById("feedBtn").classList.add("headerBtnInactive");
    document.getElementById("settingsBtn").classList.add("headerBtnInactive");
}


function bioEdit() {
    if (document.getElementById("bioReal").style.display == "none") {
        document.getElementById("bioReal").style.display = "block";
        document.getElementById("bioEdit").style.display = "none";
        document.getElementById("saveBioBtn").style.display = "none";
        document.getElementById("editBioBtn").innerHTML = "Edit";
    } else {
        document.getElementById("bioReal").style.display = "none";
        document.getElementById("editBioBtn").innerHTML = "Cancel";
        document.getElementById("saveBioBtn").style.display = "block";
        document.getElementById("bioEdit").style.display = "block";
    }
}