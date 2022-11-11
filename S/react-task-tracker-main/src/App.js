// import logo from './logo.svg';
import './App.css';
// import Mybutton from './mybutton';
import Header from './header';
import Tasks from './tasks';
import { useState } from 'react';
import AddTask from './addTask';

const App = () => {
  const [tasks,setTasks] = useState(
    [
{
    id:1,
    text:'Fun Appointment',
    day: 'Feb 5th at 2:30pm',
    reminder:true,
},
]
) 

// delete task

// add task
const addTask = (task) => {
  // console.log(task);
  const id =Math.floor(Math.random() * 10000) + 1
  // console.log(id)

  const newTask = {id, ...task}
  setTasks([...tasks,newTask])
}

  const deleteTask = (id) =>{
    // console.log('delete',id)
    setTasks(tasks.filter((task) => task.id !== id))
  }

  // toggle reminder
  const toggleReminder = (id) =>{
    // console.log(id)
setTasks(tasks.map((task) => task.id === id ? { ...task, reminder: !task.reminder } : task))
  }
  
  return(
    <div className='container'>
      {/* <Header title={1}/> */}
      <Header title='Basic Task Tracker'/>
      {/* <Header /> */}
      <AddTask onAdd={addTask} />
      {tasks.length > 0 ?(<Tasks tasks={tasks} onToggle={toggleReminder} onDelete={deleteTask}/>):('No Tasks To Show')}
    </div>
  )
}

// function App() {
  //   return (
//     <div className="App">
//       <header className="App-header">
//         <img src={logo} className="App-logo" alt="logo" />
//         <p>
//           Edit <code>src/App.js</code> and save to reload.
//         </p>
//         <a
//           className="App-link"
//           href="https://reactjs.org"
//           target="_blank"
//           rel="noopener noreferrer"
//         >
//           Learn React
//         </a>
//       </header>
//     </div>
//   );
// }


export default App;
