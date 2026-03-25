const { ccclass, requireComponent } = cc._decorator;

@ccclass
@requireComponent(cc.Sprite)
export default class StretchSprite extends cc.Component {

    onLoad() {
        this.stretchToScreen();
        if (cc.view && cc.view.setResizeCallback) {
            cc.view.setResizeCallback(() => this.stretchToScreen());
        }
    }

    stretchToScreen() {
        if (!cc.view) return;
        
        let frameSize = cc.view.getFrameSize();
        let scaleX = cc.view.getScaleX();
        let scaleY = cc.view.getScaleY();

        this.node.width = frameSize.width / scaleX;
        this.node.height = frameSize.height / scaleY;
    }
}
