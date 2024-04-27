import { createRoot } from 'react-dom/client';
import { MainLayout } from './MainLayout';

const root = createRoot(document.getElementById('app'));
const data = window.data;

root.render(<MainLayout data={data} />);
