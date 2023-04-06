<template>
  <div class="container">	  
   <button class="buy-btn" @click="showModal = true">购买须知</button>
    <form class="form" @submit.prevent="submitForm">
      <div class="form-group">
        <label for="email">邮箱</label>
        <input id="email" type="email" v-model.trim="email" required>
      </div>
      <div class="form-group">
        <label for="name">姓名</label>
        <input id="name" type="text" v-model.trim="name" required>
      </div>
      <div class="form-group">
        <label for="lunarSolar">选择日期类型</label>
        <select id="lunarSolar" v-model="lunarSolar" required>
          <option value="">请选择</option>
          <option value="阳历">阳历</option>
          <option value="阴历">阴历</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">出生日期：</label>
        <input id="birthday" type="date" v-model="birthday" :max="maxDate" :min="minDate" required>
      </div>
      <div class="form-group">
        <label for="childName">小人姓名</label>
<input id="childName" type="text" v-model.trim="childName" required placeholder="如果没有指定的人，请填写“四方天地”">
      </div>
      <div class="form-group">
        <label for="appointmentDate">预约日期</label>
        <input id="appointmentDate" type="date" v-model="appointmentDate" required>
      </div>
      <div class="form-group">
        <label for="registrationCode">注册码</label>
        <input id="registrationCode" type="text" v-model.trim="registrationCode" required>
      </div>
      <div class="form-group">
        <button type="submit" @click="submitForm">下一步</button>
      </div>
    </form>
    <div class="form-feedback">{{ feedback }}</div>
    <div class="registration-code">
      <span>还没有注册码？</span>
      <button @click="handleBuyClick">点击购买</button>
    </div>
	<div class="modal" v-show="showModal">
	  <div class="modal-content">
	    <h2 class="modal-title">购买须知</h2>
	    <p>感谢您对我们的打小人服务感兴趣。在购买服务之前，请先仔细阅读以下注意事项：</p>
	    <ol>
	      <li>打小人服务是一种传统风水习俗，仅供娱乐和个人信仰之用。</li>
	      <li>我们的打小人服务不保证一定会产生预期的效果，也不承担任何因使用该服务而产生的任何法律责任。</li>
	      <li>购买本服务需遵守当地法律法规，未成年人需在法定监护人的陪同下使用本服务。</li>
	      <li>购买成功后，我们将在2个工作日内为您提供服务。如果您需要取消服务，请在购买后的24小时内联系我们。</li>
	      <li>购买成功后，您的注册码将会发送到您填写的邮箱中。请务必保留好该注册码，以便日后查询预定进度。</li>
	      <li>如有任何疑问或需要帮助，请添加我们的微信客服进行咨询。</li>
	    </ol>
	    <button class="modal-close" @click="closeModal">×</button>
		<button class="close-btn" @click="closeModal">我知道了</button>
	  </div>
	    <div class="success-modal" v-if="showSuccessModal">
	         <h2>预约成功</h2>
	         <ul>
	           <li>邮箱：{{email}}</li>
	           <li>姓名：{{name}}</li>
	           <li>日期类型：{{lunarSolar}}</li>
	           <li>出生日期：{{birthday}}</li>
	           <li>小人姓名：{{childName}}</li>
	           <li>预约日期：{{formattedAppointmentDate}}</li>
	           <li>注册码：{{registrationCode}}</li>
	         </ul>
	         <button @click="showSuccessModal = false">确定</button>
	       </div>
	     </div>
		 </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      name: '',
      calendar: '',
      childName: '',
      appointmentDate: '',
      registrationCode: '',
      feedback: '',
      isLunarCalendar: false,
      maxDate: new Date().toISOString().split('T')[0],
      minDate: new Date('1950-01-01').toISOString().split('T')[0],
      showModal: true ,// 添加 showModal 数据属性，用于控制弹窗的显示与隐藏，默认为 true
	  showSuccessModal: false,
    };
  },
  methods: {
    submitForm() {
      // 如果所有输入都合法，将数据传递给后端
      const formData = new FormData();
      formData.append('email', this.email);
      formData.append('name', this.name);
      formData.append('lunar_solar', this.lunarSolar);
      formData.append('birthday', this.birthday);
      formData.append('child_name', this.childName);
      formData.append('appointment_date', this.appointmentDate);
      formData.append('registration_code', this.registrationCode);
      fetch('https://api.11mj.com/api/booking', {
        method: 'POST',
        body: formData
      })
        .then(response => {
          if (response.ok) {
            return response.json();
          } else {
            throw new Error('网络错误，请稍后重试！');
          }
        })
        .then(data => {
          console.log(data);
          if (data.status === 'success') {
            this.feedback = '提交成功';
			 this.showSuccessModal = true; // 设置showSuccessModal为true，显示弹窗
			 console.log(this.showSuccessModal);
          } else {
            this.feedback = '提交失败，请重试';
          }
        })
        .catch(error => {
          console.error(error);
          this.feedback = error.message;
        });
    },
	
    convertDate(date) {
      const year = date.getFullYear();
      let month = date.getMonth() + 1;
      let day = date.getDate();
  
      if (month < 10) {
        month = `0${month}`;
      }
  
      if (day < 10) {
        day = `0${day}`;
      }
  
      return `${year}/${month}/${day}`;
    },

    handleBuyClick() {
      window.open('https://zoufk.top/details/74D47C14', '_blank');
    },
    closeModal() {
      this.showModal = false; // 点击关闭按钮时设置showModal为false，隐藏弹窗
    }
  },
  computed: {
    formattedAppointmentDate() {
      if (!this.appointmentDate) {
        return '';
      }
  
      const date = new Date(this.appointmentDate);
      return this.convertDate(date);
    }
  },
  mounted() {
    this.showModal = true; // 在组件加载后将 showModal 设置为 true，显示弹窗
  }
};


</script>



<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
  padding: 30px;
}

.form-section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 30px;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 500px;
}

.form-section h2 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

.form-section ul {
  margin: 0;
  padding: 0;
  list-style: none;
  margin-top: 20px;
}

.form-section ul li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  width: 100%;
}

.form-section ul li label {
  font-size: 16px;
  margin-right: 10px;
  width: 30%;
}

.form-section ul li input[type="text"],
.form-section ul li input[type="date"],
.form-section ul li select {
  border: none;
  border-radius: 5px;
  padding: 8px;
  font-size: 16px;
  width: 70%;
}

.form-section button {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #007aff;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
}

.form-section button:hover {
  background-color: #0057ad;
}

@media screen and (max-width: 768px) {
  .form-section ul li label {
    width: 40%;
  }
  .form-section ul li input[type="text"],
  .form-section ul li input[type="date"],
  .form-section ul li select {
    width: 60%;
  }
}

.title {
  font-size: 18px;
  line-height: 1.5;
  letter-spacing: 1px;
  text-align: center;
  margin-top: 30px;
  margin-bottom: 50px;
  color: #333;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 100%;
  max-width: 400px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

label {
  font-size: 16px;
}

input,
select {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  outline: none;
}

button[type="submit"] {
  width: 200px;
    height: 50px;
    background-color: #000;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
	margin-top: 20px;
}

.form-feedback {
  margin-top: 20px;
  font-size: 16px;
  color: red;
}

.registration-code {
  margin-top: 20px;
  font-size: 16px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.registration-code span {
  margin-right: 10px;
}

.registration-code button {
  background-color: #000;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 18px;
  margin-top: 10px;
  margin-bottom: 20px;
  align-self: center;
  width: 150px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.title {
  background-color: #f5f5f5;
  border-radius: 5px;
  padding: 10px;
  font-size: 20px;
  margin-bottom: 10px;
}

.description {
  font-size: 16px;
  line-height: 1.5;
  color: #666;
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

.modal {
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

.modal-content {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  padding: 20px;
  position: relative;
  max-width: 80%;
  max-height: 80%;
  overflow: auto;
}

.close-btn {
  margin-top: 20px;
  /* 其他样式 */
}

.modal-content li {
  margin-bottom: 10px;
}

.modal-content p {
  margin-bottom: 10px;
}

.modal-title {
  text-align: center;
  margin-top: 10px;
  margin-bottom: 10px;
}

@media screen and (max-width: 640px) {
  .modal-content {
    max-width: 90%;
  }
}

@media screen and (max-width: 480px) {
  .modal-content {
    max-width: 80%;
  }
}

.success-modal {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0,0,0,.3);
  color: #4bbd6e;
  display: flex;
  font-size: 16px;
  justify-content: center;
  align-items: center;
  height: 80px;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 200px;
  z-index: 999;
}

</style>
