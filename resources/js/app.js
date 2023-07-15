import "./bootstrap";
import Alpine from "alpinejs";
import Focus from "@alpinejs/focus";
import FormsAlpinePlugin from "../../vendor/filament/forms/dist/module.esm";
import NotificationsAlpinePlugin from "../../vendor/filament/notifications/dist/module.esm";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);
Alpine.plugin(Focus);
Alpine.plugin(FormsAlpinePlugin);
Alpine.plugin(NotificationsAlpinePlugin);
window.Alpine = Alpine;
Alpine.start();

Echo.private("App.Models.User.1").notification((notification) => {
    console.log(notification);
});
