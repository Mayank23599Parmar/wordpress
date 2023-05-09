class MyNotes {
  constructor() {
    this.deleteBTN = document.querySelectorAll(".delete-note");
    this.editBTN = document.querySelectorAll(".edit-note");
    this.cancleBtn = document.querySelectorAll(".cancle-note");
    this.updatePost = document.querySelectorAll(".save-note");
    this.createPostBtn = document.querySelector(".create-note");
    this.events()

  }
  //events
  events() {
    //delete notes event
    if (this.deleteBTN) {
      this.deleteBTN.forEach((btn) => {
        btn.addEventListener("click", this.deleteNotes.bind(btn))
      })
    }
    // EDIT notes Events
    if (this.editBTN) {
      this.editBTN.forEach((btn) => {
        btn.addEventListener("click", this.editNotes.bind(btn))
      })
    }
    // cancle button 
    if (this.cancleBtn) {
      this.cancleBtn.forEach((btn) => {
        btn.addEventListener("click", this.cancleBTNClick.bind(btn))
      })
    }
    //update post
    if (this.updatePost) {
      this.updatePost.forEach((btn) => {
        btn.addEventListener("click", this.updatePostClick.bind(btn))
      })
    }
    if(this.createPostBtn){
      this.createPostBtn.addEventListener("submit",this.addNote.bind(this))
    }
  }

  // method 
  async deleteNotes(btn) {
    const id = btn.currentTarget.dataset.id
    const url = `${siteData.root_url}/wp-json/wp/v2/note/${id}`
    const res = await fetch(url, {
      method: "DELETE",
      headers: {
        "X-WP-Nonce": `${siteData.nonce}`,
      }
    })
    if (res.status == 200) {
     window.location.reload()
    }
    console.log(res, "ddd");
  }
    editNotes(btn) {
    const editBtn = btn.currentTarget
    const parent = editBtn.closest("li");
    const cancleBtn = parent.querySelector(".cancle-note")
    const input = parent.querySelector(".note-title-field");
    const saveBtn=parent.querySelector(".save-note");
    const textArea = parent.querySelector(".note-body-field")
    if (input && textArea) {
      input.removeAttribute("readonly")
      input.classList.add("note-active-field");
      textArea.removeAttribute("readonly")
      textArea.classList.add("note-active-field");
      editBtn.classList.add("hide")
      editBtn.classList.remove("show")
      cancleBtn.classList.remove("hide")
      cancleBtn.classList.add("show")
      saveBtn.classList.remove("hide")
      saveBtn.classList.add("show")
    }
  }
  cancleBTNClick(btn){
    const cancletBtn = btn.currentTarget
    console.log(cancletBtn);
    const parent = cancletBtn.closest("li");
    const editBtn = parent.querySelector(".edit-note")
    const input = parent.querySelector(".note-title-field");
    const textArea = parent.querySelector(".note-body-field")
    const saveBtn=parent.querySelector(".save-note");

    if (input && textArea) {
      input.setAttribute("readonly",true)
      input.classList.remove("note-active-field");
      textArea.setAttribute("readonly",true)
      textArea.classList.remove("note-active-field");
      editBtn.classList.remove("hide")
      editBtn.classList.add("show")
      cancletBtn.classList.remove("show")
      cancletBtn.classList.add("hide")
      saveBtn.classList.remove("show")
      saveBtn.classList.add("hide")
    }
  }
  async updatePostClick(btn){
    const updatePostBTN = btn.currentTarget
    const id = updatePostBTN.dataset.id
    const parent = updatePostBTN.closest("li");
    const input = parent.querySelector(".note-title-field");
    const textArea = parent.querySelector(".note-body-field")
    if(input && textArea){
      const data={
        "title":input.value,
      
        "content":textArea.value
      }
      const url = `${siteData.root_url}/wp-json/wp/v2/note/${id}`
      const res = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": `${siteData.nonce}`,
        },
        body:JSON.stringify(data)
      })
      if (res.status == 200) {
       window.location.reload()
      }
      console.log(res,"aaaa");
    }
  }
 async addNote(e){
   e.preventDefault()
   const form= e.currentTarget
   const input = form.querySelector(".title-filed");
   const textArea = form.querySelector(".body-field")
   if(input && textArea){
    const data={
      "title":input.value.trim(),
      "content":textArea.value.trim(),
      "status":"publish"
    }
    const id = form.dataset.id
    const url = `${siteData.root_url}/wp-json/wp/v2/note`
    const res = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": `${siteData.nonce}`,
      },
      body:JSON.stringify(data)
    })
    const response= await res.text()
    console.log(response,"Sss");
    if (res.ok) {
      console.log(res,"Sss");
    }
    console.log(res,"aaaa");
  }
  }
}

export default MyNotes