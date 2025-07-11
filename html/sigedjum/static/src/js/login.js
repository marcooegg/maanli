const { createApp } = Vue;
// import axios from 'axios';
createApp({
    data() {
        return {
            email: '',
            password: ''
        };
    },
    methods: {
        handleLogin() {
            // alert(`Email: ${this.email}\nPassword: ${this.password}`);
            axios.post('api/login.php', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                console.log('Response from server:', response.data);
                if (response.data.success) {
                    // window.location.href = '/dashboard';
                    console.log('Login successful:', response.data);
                } else {
                    console.error('Login failed:', response.data);
                    alert('Login failed. Please check your credentials.');
                }
            })
            .catch(error => {
                console.error('There was an error during the login process:', error);
            });
        },
        
    }
}).mount('#app');