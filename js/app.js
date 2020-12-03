new Vue({
  el: "#app",
  data: {
    msg: "Welcome"
  },
  methods: {
    sayHello() {
      this.msg = 'hello'
    },
    like: function (id) {
      console.log(id)
      axios.post('./php/api/like.php', {
        id: id
      })
        .then(res => {
          console.log(res.data)
          let id = res.data.id
          let status = res.data.status
          console.log(this.$refs[id])
          location.reload()
        })
    }
  },
  mounted () {

  }
});