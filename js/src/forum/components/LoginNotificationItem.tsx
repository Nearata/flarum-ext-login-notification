import Component from "flarum/common/Component";
import Switch from "flarum/common/components/Switch";
import User from "flarum/common/models/User";
import app from "flarum/forum/app";
import type Mithril from "mithril";

export default class LoginNotificationItem extends Component {
  user!: User;
  loading!: boolean;

  oninit(vnode: Mithril.Vnode<this>): void {
    super.oninit(vnode);

    this.user = this.attrs.user;
    this.loading = false;
  }

  oncreate(vnode: Mithril.VnodeDOM<this>): void {
    super.oncreate(vnode);
  }

  view(vnode: Mithril.Vnode<this>) {
    return (
      <Switch
        state={this.user.preferences()!.nearataLoginNotification}
        loading={this.loading}
        onchange={this.onchange.bind(this)}
      >
        {app.translator.trans(
          "nearata-login-notification.forum.settings.switch_label"
        )}
      </Switch>
    );
  }

  onchange(value: boolean) {
    this.loading = true;

    this.user.savePreferences({ nearataLoginNotification: value }).then(() => {
      this.loading = false;
      m.redraw();
    });
  }
}
