import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

Echo.private("App.Models.User.1").notification((notification) => {
    console.log(notification);
});
