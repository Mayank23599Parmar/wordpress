import "./index.scss";
import EditComponents from "./components/EditComponents";
function checkAnswerSelectedOrNot() {
    let lock = false;
    wp.data.subscribe(function(){
      

        const result = wp.data.select("core/block-editor").getBlocks().filter((block) => {
            if (block.name == "our-plugin/our-attention" && block.attributes.correctAnswer == undefined) {
                return block
            }
        })
        if (result.length && lock==false) {
            lock = true
            wp.data.dispatch("core/editor").lockPostSaving("noanswer")
        }
        
        if (lock == true && !result.length) {
            lock=false
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer")
        } 
    })
   

}
checkAnswerSelectedOrNot()
wp.blocks.registerBlockType("our-plugin/our-attention", {
    title: "Attintion plugin",
    icon: "smiley",
    category: "comman",
    attributes: {
        question: { type: "string" },
        answers: { type: 'array', default: [""] },
        correctAnswer: { type: "number", default: undefined },
        bgColor: { type: "string", default: "#C43E3E" },
        titleAlignMent:{ type: "string", default: "left" },
    },
    description:"This plugin use for view to play quiz",
    example:{
        attributes: {
            question: "What is 2+2 ?",
            answers: [64,4,5,6],
            correctAnswer: 1,
            bgColor: "#C43E3E" ,
            titleAlignMent: "left" ,
        }
    },
    edit: (prop) => {
        return <EditComponents data={prop} />
    },
    save: (props) => {
        console.log(props, "aaaaa");
        return null
    }
})