import LoginNotificationItem from "./components/LoginNotificationItem";
import { extend } from "flarum/common/extend";
import app from "flarum/forum/app";
import SettingsPage from "flarum/forum/components/SettingsPage";

app.initializers.add("nearata-login-notification", () => {
  extend(SettingsPage.prototype, "notificationsItems", function (items) {
    items.add(
      "nearataLoginNotification",
      LoginNotificationItem.component({ user: this.user }),
      -1
    );
  });
});
