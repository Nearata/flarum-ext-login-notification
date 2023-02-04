import app from "flarum/forum/app";

app.initializers.add("nearata/flarum-ext-login-notification", () => {
  console.log("[nearata/flarum-ext-login-notification] Hello, forum!");
});
