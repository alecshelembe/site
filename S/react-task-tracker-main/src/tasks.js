import React from 'react'
import Task from './task'

const Tasks = (props) => {
  return (
    <>
    {props.tasks.map((task)=>(
        <Task key={task.id} onToggle={props.onToggle} day={task.day} onDelete={props.onDelete} id={task.id} reminder={task.reminder} tasks={task.text}/>
        ))}
    </>
  )
}

export default Tasks