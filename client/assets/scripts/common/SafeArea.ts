const { ccclass, requireComponent } = cc._decorator;

@ccclass
@requireComponent(cc.Widget)
export default class SafeArea extends cc.Component {

    onLoad() {
        this.applySafeArea();
        if (cc.view && cc.view.setResizeCallback) {
            cc.view.setResizeCallback(() => this.applySafeArea());
        }
    }

    applySafeArea() {
        let widget = this.getComponent(cc.Widget);
        if (!widget) return;

        // Cocos Creator 2.x method
        let safeArea = cc.sys.getSafeAreaRect();
        let visibleSize = cc.view.getVisibleSize();

        if (safeArea && (safeArea.width < visibleSize.width || safeArea.height < visibleSize.height)) {
            widget.isAlignLeft = true;
            widget.isAlignRight = true;
            widget.isAlignTop = true;
            widget.isAlignBottom = true;

            widget.left = safeArea.x;
            widget.right = visibleSize.width - (safeArea.x + safeArea.width);
            widget.bottom = safeArea.y;
            widget.top = visibleSize.height - (safeArea.y + safeArea.height);

            widget.updateAlignment();
        }
    }
}
