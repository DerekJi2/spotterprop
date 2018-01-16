var nsRedirect = nsRedirect || {};

nsRedirect.AdminRoot = function(){
    return "";
}

nsRedirect.OnLoad = function() {
    nsRedirect.EventRegister();
}

nsRedirect.EventRegister = function(){
    
    $('.btn-admin-signin').click(function(){
        nsRedirect.SignIn();
    });

    $('.btn-admin-register').click(function(){
        nsRedirect.Register();
    });
}

nsRedirect.SignIn = function() {
    var rootUrl = nsRedirect.AdminRoot();
    window.open(rootUrl + "/sign-in/");
}

nsRedirect.Register = function() {
    var rootUrl = nsRedirect.AdminRoot();
    window.open(rootUrl + "/sign-up/");
}