import EditComponent from "./components/EditComponent";
import "./index.scss";
wp.blocks.registerBlockType("our-plugin/feature-proffessor", {
    title: "Feature Proffessor",
    description: "This plugin use for feature proffessor in blog post",
    category: "widgets",
    icon: "admin-users",
    attributes: {
        profId: {type: "string"}
    },
    edit: (props) => {
        return <EditComponent data={props}/>
    },
    save: () => {
        return null
    }

});