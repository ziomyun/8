<template>
  <div class="bg-image">
    <div class="container">
      <div class="header">
        <h1 class="logo">爻爻秘籍-香港專業風水服務</h1>
		</div>
        <button class="header-button">登录</button>
		 <div class="time-info">
		        <div class="time-info-item">
		          <span class="label">总计提供打小人服务次数：</span>
		          <span class="value">{{ serviceCount }}次</span>
		        </div>
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
      serviceCount: 985, // 存储小人服务次数的变量
	  showPopup: false, // 控制弹窗的显示
	  submitContent: '', // 存储提交的内容
    };
  },
  mounted() {
    setInterval(() => {
      const now = new Date();
      this.currentTime = now.toLocaleString();
    }, 1000);
    
    setInterval(() => {
      const countIncrease = Math.floor(Math.random() * 21) + 10;
      this.serviceCount += countIncrease;
    }, 86400000); // 每24小时增加一次
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
  background-color: rgba(16, 16, 16, 0.8);
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
  background-color: rgba(16, 16, 16, 0.8);
  padding: 10px;
  position: absolute;
  top: 30%;
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
  margin-top: 40px;
}

.watch-video a {
  font-size: 24px;
  color: #f00;
  text-decoration: none;
  border: 2px solid #000;
  padding: 10px 20px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.watch-video a:hover {
  background-color: #000;
  color: #fff;
}

</style>
