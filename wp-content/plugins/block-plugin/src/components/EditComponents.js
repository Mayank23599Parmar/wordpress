import { Button, Flex, FlexBlock, FlexItem, Icon, TextControl,PanelBody,PanelRow ,ColorPicker} from '@wordpress/components';
import {InspectorControls,BlockControls,AlignmentToolbar} from '@wordpress/block-editor';
export default function EditComponents({ data }) {
    console.log(data, 'propprop');
    const { attributes, setAttributes } = data
    const handleValue = (value) => {
        setAttributes({ question: value })
    }
    const handleAnserChange=(e,index)=>{
        const newAnswer=[...attributes.answers]
        newAnswer[index]=e
        setAttributes({answers:newAnswer})
        console.log(newAnswer,'newAnswernewAnswer');
    
    }
    const addAnswer=()=>{
        setAttributes({answers:[...attributes.answers,""]})
    }
    const deleteAnswer=(index)=>{
        setAttributes({answers:attributes.answers.filter((cv,i)=> i != index)})
        if(index == attributes.correctAnswer){
            setAttributes({correctAnswer:undefined})  
        }
    }
    const makeAnswer=(index)=>{
        setAttributes({correctAnswer:index})
    }
    const changeColor=(e)=>{
        setAttributes({bgColor:e})
    }
    return (
        <div className='our-attention' style={{background:attributes.bgColor}}>
        <BlockControls>
            <AlignmentToolbar value={attributes.titleAlignMent} onChange={(e)=>setAttributes({titleAlignMent:e})}/>
        </BlockControls>
        <InspectorControls>
            <PanelBody title='Background Color' initialOpen={true}> 
                <PanelRow>
                    <ColorPicker value={attributes.bgColor} onChange={changeColor}/>
                </PanelRow>
            </PanelBody>
        </InspectorControls>
            <TextControl label="Ask Questions" value={attributes.question} className='question-title' onChange={handleValue} />
            <p className='answer-title'>Answer</p>

            {
                attributes.answers.map((ans, index) => {
                    return <Flex className="answer-wrapper" key={index}>
                        <FlexBlock >
                            <TextControl value={ans} onChange={(e)=>handleAnserChange(e,index)}/>
                        </FlexBlock>
                        <FlexItem>
                            <Icon onClick={()=>makeAnswer(index)} icon={`${attributes.correctAnswer == index?"star-filled":"star-empty"}`}  className='icon' />
                        </FlexItem>
                        <FlexItem>
                            <Button className='delete-btn' onClick={()=>deleteAnswer(index)}>Delete</Button>
                        </FlexItem>
                    </Flex>
                })
            }
            <Button variant='primary' onClick={addAnswer}>Add Answer</Button>
        </div>
    )
}
