import React from 'react'
import { FaTimes } from 'react-icons/fa'

const Task = (props) => {
  return (
    <>
    <div style={{float:'right', margin:'20px'}}><FaTimes onClick={() => props.onDelete(props.id) } style={{color:'red', cursor: 'pointer'}}/></div>
    <div className={`task ${props.reminder ? 'reminder' : ''}`} onClick={() => props.onToggle(props.id)}>
        <h3>{props.tasks}</h3>
        <p>{props.day}</p>     
    </div>
    </>
    
  )
}

export default Task