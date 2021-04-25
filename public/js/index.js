new Vue({
    el: "#app",
    data() {
        return {
            title: "",
            content: "",
            edit_modal: "",
            delete_modal: ""
        }
    },
    methods: {
        getValue: function(id) {
            this.title = document.getElementById("title_"+id)
            this.content = document.getElementById("content_"+id)
            document.getElementById("id").value = id   
        },
        openEditModal: function(id) {
            this.getValue(id)
            document.getElementById("edit_title").value = this.title.innerHTML
            document.getElementById("edit_content").value = this.content.innerHTML
            this.edit_modal = "is-active"
        },
        openDeleteModal : function(id) {
            this.getValue(id)
            document.getElementById("titles").innerHTML = this.title.innerHTML
            document.getElementById("contents").innerHTML = this.content.innerHTML
            this.delete_modal = "is-active"
        },
        closeModal : function() {
            this.title = ""
            this.content = ""
            this.edit_modal = ""
            this.delete_modal = ""
        }
    }
})
