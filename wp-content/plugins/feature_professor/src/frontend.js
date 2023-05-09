import './frontend.scss';
import React, { useState, useEffect } from 'react';
import ReactDom from 'react-dom';
const frontendFeatureProffessorDivs = document.querySelectorAll(".frontend_feature_professor");
if (frontendFeatureProffessorDivs) {
    frontendFeatureProffessorDivs.forEach((div) => {
        const jsonData = JSON.parse(div.querySelector("pre").innerHTML)
        ReactDom.render(<FeatureProffessor data={jsonData} />, div)
    })
}

function FeatureProffessor({ data }) {
    const { profId } = data
    const [proffessorData, setData] = useState()
    const fetchProfeessorData = async () => {
        const res = await fetch(`http://localhost/wordpress/wp-json/feature/v1/proffessor?id=${profId}`);
        const resJson = await res.json()
        setData(resJson)
    }
    useEffect(() => {
        fetchProfeessorData()
    }, [])
    if (!proffessorData) {
        return <h1>Loading ...</h1>
    }
    console.log(proffessorData, "dededed");
    return <div class="professor-callout">
        <div class="professor-callout__photo" style={{backgroundImage:`url(${proffessorData.img})`}}></div>
        <div class="professor-callout__text">
            <h5>{proffessorData.title}</h5>
            <p>{proffessorData.description}</p>
            {
                proffessorData.relatedPrograms.map((cv, index) => {
                    return <><a href={cv.url} key={index}>{cv.title}</a><br/></>
                })
            }

            <p><strong><a href={proffessorData.url}>Learn more about {proffessorData.title} &raquo;</a></strong></p>

        </div>
    </div>
} 