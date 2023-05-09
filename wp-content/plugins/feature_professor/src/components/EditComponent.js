import React,{useState,useEffect} from 'react'
import {useSelect} from '@wordpress/data';
import { Spinner } from '@wordpress/components';
export default function EditComponent({data}) {
    const {setAttributes,attributes}=data
  const proffessorData=  useSelect((select)=>{
    //wp.data.select("core").getEntityRecords("postType","professor",{per_page:-1})
   return select("core").getEntityRecords("postType","professor",{per_page:-1})
  })
  const [proffessorObj, setData] = useState()
    const fetchProfeessorData = async () => {
        const res = await fetch(`http://localhost/wordpress/wp-json/feature/v1/proffessor?id=${attributes.profId }`);
        const resJson = await res.json()
        setData(resJson)
    }
    useEffect(() => {
        fetchProfeessorData()
    }, [attributes.profId ])
    if (!proffessorData || !proffessorObj) {
        return <h1>Loading ...</h1>
    }

  if(!proffessorData){
    return <Spinner />
  }
console.log(proffessorObj);
  return (
    <div className="featured-professor-wrapper">
    <div className="professor-select-container">
      <select onChange={e => setAttributes({profId: e.target.value})}>
        <option value="">Select a professor</option>
        {
            proffessorData.map((proffessor,index)=>{
           return  <option value={proffessor.id} key={index} selected={attributes.profId == proffessor.id} style={{textTransform:"capitalize"}}>{proffessor.slug.replaceAll("-"," ")}</option>
            })
        }
      </select>
    </div>
    <div class="professor-callout">
        <div class="professor-callout__photo" style={{backgroundImage:`url(${proffessorObj.img})`}}></div>
        <div class="professor-callout__text">
            <h5>{proffessorObj.title}</h5>
            <p>{proffessorObj.description}</p>
            {
              proffessorObj.relatedPrograms.map((cv, index) => {
                    return <><a href={cv.url} key={index}>{cv.title}</a><br/></>
                })
            }

            <p><strong><a href={proffessorObj.url}>Learn more about {proffessorObj.title} &raquo;</a></strong></p>

        </div>
    </div>
  </div>
  )
}
