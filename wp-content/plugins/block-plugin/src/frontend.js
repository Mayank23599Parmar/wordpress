import "./frontend.scss";
import React ,{useState,useEffect} from 'react';
import ReactDom from 'react-dom';
const blockOutPut = document.querySelectorAll(".block-output");
if (blockOutPut) {
    blockOutPut.forEach((div) => {
        const jsonData = JSON.parse(div.querySelector("pre").innerHTML)
        ReactDom.render(<Quiz data={jsonData} />, div)
    })
}

function Quiz({ data }) {
    console.log(data, 'datadata');
    const { answers, question, correctAnswer ,bgColor,titleAlignMent} = data
    const [isCorect, setIsCorrect] = useState()
    const handleAnswer=(index)=>{
      if(correctAnswer == index){
        setIsCorrect(true)
      }else{
        setIsCorrect(false)
      }
    }
    useEffect(() => {
        let timer1=  setTimeout(()=>{
            setIsCorrect(undefined)
          },1000)
       return () => {
            clearTimeout(timer1);
          }
       
    }, [isCorect])
    
    return <div className="paying-attention-frontend" style={{background:bgColor}}>
        <p style={{textAlign:titleAlignMent}}>  {    question}</p>
        <ul>
            {
                answers.map((cv,index)=>{
                    return <li key={index} onClick={()=>handleAnswer(index)}>{cv}</li>
                })
            }
        </ul>
        <div className={`correct-message  ${isCorect == true && "correct-message--visible"}`}>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-emoji-smile" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
        </svg>
            <p>THis is correact answer</p>
        </div>
        <div className={`incorrect-message  ${isCorect == false && "correct-message--visible"}`}>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" className="bi bi-emoji-frown" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
        </svg>
        <p>Sorry, try again.</p>
      </div>
    </div>
}