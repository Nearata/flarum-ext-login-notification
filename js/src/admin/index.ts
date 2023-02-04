import app from "flarum/admin/app";

app.initializers.add("nearata/flarum-ext-login-notification", () => {
  console.log("[nearata/flarum-ext-login-notification] Hello, admin!");
});
