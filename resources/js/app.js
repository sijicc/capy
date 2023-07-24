import "./bootstrap";

Echo.private("App.Models.User.1").notification((notification) => {
    console.log(notification);
});
