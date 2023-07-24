import "./bootstrap";

Echo.private("App.Models.User.1").notification((notification) => {
    dispatchEvent(new Event("new-notification"));
});
