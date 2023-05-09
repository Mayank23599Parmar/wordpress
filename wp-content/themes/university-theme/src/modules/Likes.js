class Likes {
    constructor() {
        this.likesDiv = document.querySelector(".like-box")
        this.events()
    }
    events() {
        if (this.likesDiv) {
            this.likesDiv.addEventListener("click", this.likeBtnClick.bind(this))
        }
    }
    likeBtnClick(btn) {
        const likeBox = btn.currentTarget
         if(likeBox.dataset.exists == "yes"){
            this.removeLike(likeBox)
         }else{
            this.addLikes(likeBox)
         }
    }
    async removeLike(likeBox){
        const url = `${siteData.root_url}/wp-json/university/vi/manage-like`
        const res = await fetch(url, {
          method: "DELETE",
          body:JSON.stringify({likeid:likeBox.dataset.likeid}),
          headers: {
            "Content-Type": "application/json",
            "X-WP-Nonce": `${siteData.nonce}`,
          },
        })
        const response= await res.json()
          if(response.success){
           window.location.reload()
          }
        console.log(res);
    }
   async addLikes(likeBox){
        const url = `${siteData.root_url}/wp-json/university/vi/manage-like`
        const res = await fetch(url, {
          method: "POST",
          body:JSON.stringify({professor_id:likeBox.dataset.profesorid}),
          headers: {
            "Content-Type": "application/json",
            "X-WP-Nonce": `${siteData.nonce}`,
          },
        })
        const response= await res.json()
          if(response.success){
           window.location.reload()
          }
        console.log(res);
    }
}
export default Likes