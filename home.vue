<template>
  <div class="bg-image">
    <div class="container">
      <div class="header">
        <h1 class="logo">爻爻秘籍-香港專業風水服務</h1>
		</div>
        <button class="header-button">登录</button>
		 <div class="time-info">
		        <div class="time-info-item">
		          <span class="label">当前时间：</span>
		          <span class="value">{{ currentTime }}</span>
		        </div>
				<span class="label" @click="copyWechat">点击复制微信号：HK_Culture </span>
		      </div>
						<div class="watch-video">
						  <a href="https://jinmantv.com/ad/dxr.mp4" target="_blank">点击观看打小人视频</a>
						</div>

      <div class="content">
        <div class="button-group">
          <button class="button" @click="toAppointment">要打小人</button>
          <button class="button" @click="toProgress">查询进度</button>
          <button class="button" @click="toCases">客户案例</button>
          <button class="button" @click="toContact">在线联系</button>
        </div>
        <div v-if="showContact" class="contact-modal">
          <div class="contact-modal-content">
            <button class="close-btn" @click="closeContact">×</button>
            <p class="wx-id" @click="copyWechat">点击复制微信号：HK_Culture</p>
            <img class="wx-qrcode" src="/static/wechat-qr-code.jpg" alt="微信二维码">
            <p class="wx-qrcode-tip">点击长按下载微信二维码</p>
            <a class="btn-consult" href="https://qq.40tl.com/livechat" target="_blank">在线咨询</a>
          </div>
        </div>
      </div>
      <div class="footer">
        <bottom-navigation></bottom-navigation>
      </div>
	  <div class="popup" v-if="showPopup">
	    <div class="popup-content">
	      <h2>提交成功</h2>
	      <p>{{ submitContent }}</p>
	      <button class="close-button" @click="closePopup">关闭</button>
	    </div>
	  </div>
    </div>
  </div>
 <div class="tc-modal" v-show="showModal">
   <div class="tc-modal-content">
     <h2 class="tc-modal-title">爻爻秘籍</h2>
     <p>香港专业风水服务团队为您服务！</p>
     <p>什么情况需要打小人?</p>
       <li>身边有小三破坏感情。</li>
       <li>生活和工作中遭到背后算计！</li>
       <li>家庭生活不顺，如家庭成员间的矛盾、争吵、不和谐</li>
       <li>感受到运势低迷，希望通过驱邪化解晦气，提升运势。</li>
     <button class="modal-close" @click="closeModal">×</button>
     <button class="tc-close-btn" @click="closeModal">我知道了</button>
   </div>
 </div>
<div class="why-play">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="section-title">为什么需要打小人？</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="why-play-item">
            <div class="why-play-icon"><i class="fas fa-shield-alt"></i></div>
            <h3 class="why-play-title">减压、放松心情</h3>
            <p class="why-play-desc">打小人可以让人将心中的不满、不爽等情绪化为力量，缓解生活中的压力和疲劳。</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="why-play-item">
            <div class="why-play-icon"><i class="fas fa-user-secret"></i></div>
            <h3 class="why-play-title">释放情感</h3>
            <p class="why-play-desc">打小人可以让人发泄内心的情感，让人的心情得到了很好的舒缓和释放。</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="why-play-item">
            <div class="why-play-icon"><i class="fas fa-hand-rock"></i></div>
            <h3 class="why-play-title">培养毅力和耐力</h3>
            <p class="why-play-desc">打小人需要坚持不懈的努力，可以帮助人们培养毅力和耐力，更好地面对生活中的挑战。</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="why-play-item">
            <div class="why-play-icon"><i class="fas fa-flag-checkered"></i></div>
            <h3 class="why-play-title">提高专注力和反应能力</h3>
            <p class="why-play-desc">打小人需要高度的专注力和快速的反应能力，可以帮助人们提高这些方面的能力。</p>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</template>
<script>
import BottomNavigation from '@/components/BottomNavigation.vue';

export default {
  components: {
    BottomNavigation,
  },
  data() {
    return {
      showContact: false,
      currentTime: '', // 存储当前时间的变量
	  showPopup: false, // 控制弹窗的显示
	  submitContent: '', // 存储提交的内容
	  showModal: true,// 添加 showModal 数据属性，用于控制弹窗的显示与隐藏，默认为 true
    };
  },
  mounted() {
    setInterval(() => {
      const now = new Date();
      this.currentTime = now.toLocaleString();
    }, 1000);
  },
  methods: {
    toAppointment() {
      uni.navigateTo({
        url: '/pages/index/yy',
      });
    },
    toProgress() {
      // 跳转到查询进度页面
    },
    toCases() {
      // 跳转到客户案例页面
    },
    toContact() {
      this.showContact = true;
    },
    closeContact() {
      this.showContact = false;
    },
	closeModal() {
	  this.showModal = false; // 点击关闭按钮时设置showModal为false，隐藏弹窗
	},
    copyWechat() {
      const wechat = 'HK_Culture';
      const input = document.createElement('input');
      input.setAttribute('value', wechat);
      document.body.appendChild(input);
      input.select();
      document.execCommand('copy');
      document.body.removeChild(input);
      uni.showToast({
        title: '微信号已复制',
      });
    },
  },
};
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@300;400;500;700&display=swap');

body {
  overflow: auto;
}

.bg-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('/static/bg.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Noto Sans SC', sans-serif;
}

.container {
  height: 100vh;
  display: flex;
  flex-direction: column;
}

.header {
  position: fixed;
  width: 100%;
  height: 50px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: rgba(16, 16, 16, 0.8);
  padding: 0 20px;
}

.logo {
  color: #fff;
  font-size: 18px;
    margin-right: auto;
}

.header-button {
  background-color: rgba(16, 16, 16, 0.8);
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
  margin-left: auto;
}

.content {
  flex: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}

.button-group {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  justify-items: center;
  align-items: center;
  padding: 40px;
}

.button {
  background-color: rgb(14 104 86 / 80%);
  color: #fff;
  padding: 12px 24px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  margin: 20px 0;
  text-align: center;
  width: 160px;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #0f3a26;
}

.contact-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  width: 80%;
  max-width: 600px;
  height: 80%;
  max-height: 800px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.contact-modal-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.wx-id {
  font-size: 18px;
  margin-bottom: 10px;
}

.wx-qrcode {
  width: 80%;
  max-width: 300px;
  height: auto;
  margin: 0px auto;
  display: block;
}

.btn-consult {
  background-color: rgba(16, 16, 16, 0.8);
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 18px;
  text-decoration: none;
  margin-top: 20px;
  transition: background-color 0.3s ease;
}

.btn-consult:hover {
  background-color: #0f3a26;
}

.wx-qrcode-tip {
  font-size: 14px;
  margin-top: 10px;
}

.close-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 24px;
  color: #000;
  border: none;
  background: none;
  cursor: pointer;
  transition: color 0.3s ease;
}

.close-btn:hover {
  color: #303030;
}

.footer {
  height: 50px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #000000;
}

.tab-item {
  color: #cccccc; /* 修改默认文字颜色 */
  font-size: 18px;
  cursor: pointer;
  transition: color 0.3s ease;
}

.tab-item:hover {
  color: #000000;
}

.time-info {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background-color: rgb(14 104 86 / 80%);
  padding: 10px;
  position: absolute;
  top: 37%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%;
  max-width: 90%;
  text-align: center;
}

.time-info-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.label {
  font-size: 16px;
  font-weight: bold;
  margin-right: 10px;
  color: #fff;
}

.value {
  font-size: 16px;
  color: #fff;
}

.watch-video {
  display: flex;
  justify-content: center;
  margin-top: 80px;
}

.watch-video a {
  font-size: 24px;
  color: #fff;
  text-decoration: none;
  border: 2px solid #000;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  background-color: rgb(14 104 86 / 80%);
}

.watch-video a:hover {
  background-color: #000;
  color: #fff;
}

.tc-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

.tc-modal-content {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 20px;
  position: relative;
  max-width: 80%;
  max-height: 80%;
  overflow: auto;
}

.tc-close-btn {
  margin-top: 20px;
  /* 其他样式 */
}

.tc-modal-content li {
  margin-bottom: 10px;
}

.tc-modal-content p {
  margin-bottom: 10px;
}

.tc-modal-title {
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}

@media screen and (max-width: 640px) {
  .tc-modal-content {
    max-width: 90%;
  }
}

@media screen and (max-width: 480px) {
  .tc-modal-content {
    max-width: 80%;
  }
}

/* 关闭按钮 */
.modal-close {
  position: absolute;
  top: 0;
  right: 0;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  color: #666;
  cursor: pointer;
}

 .why-play {
    background-color: #fff;
    padding: 80px 0;
  }

  .why-play .section-title {
    font-size: 36px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 60px;
  }

  .why-play-item {
    margin-bottom: 50px;
    text-align: center;
  }

  .why-play-icon {
    font-size: 50px;
    color: #2e3192;
    margin-bottom: 30px;
  }

  .why-play-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .why-play-desc {
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  margin-top: 20px;
  }
  
  .section {
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }
  
  .section-text {
    width: 600px;
    margin-right: 50px;
    font-size: 24px;
    line-height: 1.5;
  }
  
  .section-text h2 {
    font-size: 36px;
    margin-bottom: 30px;
  }
  
  .section-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 200px;
    height: 60px;
    font-size: 20px;
    color: #fff;
    background-color: #00bcd4;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
  }
  
  .section-btn:hover {
    transform: scale(1.1);
    background-color: #0097a7;
  }

	
</style>
