import { createRoot } from 'react-dom/client';

import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';

// Your actual form component
export default function ConsultationForm() {
    return (
        <div className="p-6">
            <h2 className="mb-4 text-2xl font-bold">React Form</h2>
            <form>
                <input
                    type="text"
                    placeholder="Enter something..."
                    className="w-full rounded border p-2"
                />
                <div>
                    <Label htmlFor="consultation_with">Doctor Name</Label>
                    <div className="w-[250px]">
                        <Select>
                            <SelectTrigger className="w-full">
                                <SelectValue placeholder="Select Doctor" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="dr-verma">
                                    Dr. Verma
                                </SelectItem>
                                <SelectItem value="dr-singh">
                                    Dr. Singh
                                </SelectItem>
                                <SelectItem value="dr-sharma">
                                    Dr. Sharma
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                </div>
            </form>
        </div>
    );
}

// Mount the component to the div inside your Blade view
const container = document.getElementById('consultation-react');
if (container) {
    const root = createRoot(container);
    root.render(<ConsultationForm />);
}
